<?php

namespace App\Service;

use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{

    public function store(array $data): Post
    {
        try {
            DB::beginTransaction();
            if (isset($data['tags_ids'])) {
                $tagIds = $data['tags_ids'];
                unset($data['tags_ids']);
            }

            $data = $this->createOrUpdateImages($data);

            $post = Post::firstOrCreate($data);
            if (isset($tagIds)) {
                $post->tags()->sync($tagIds);
            }

            DB::commit();
            return $post;
        } catch (Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function update(Post $post, array $data): Post
    {
        $data = $this->createOrUpdateImages($data);

        return DB::transaction(function() use($post, $data) {
            $post->update($data);
            if (isset($data['tags_ids'])) {
                $post->tags()->sync($data['tags_ids']);
            }
            return $post;
        });

        try {
            DB::beginTransaction();
            if (isset($data['tags_ids'])) {
                $tagIds = $data['tags_ids'];
                unset($data['tags_ids']);
            }
            if (isset($data['main_image'])) {
                $data['main_image'] = Storage::disk('public')->put('/index', $data['main_image']);
            };
            if (isset($data['main_image'])) {
                $data['preview_image'] = Storage::disk('public')->put('/index', $data['preview_image']);
            };
            $post->update($data);
            if (isset($tagIds)) {
                $post->tags()->sync($tagIds);
            }
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception);

        }
        return $post;
    }

    private function createOrUpdateImages(array $data): array
    {
        if (isset($data['main_image'])) {
            $data['main_image'] = Storage::disk('public')->put('/index', $data['main_image']);
        }
        if (isset($data['main_image'])) {
            $data['preview_image'] = Storage::disk('public')->put('/index', $data['preview_image']);
        }

        return $data;
    }
}
