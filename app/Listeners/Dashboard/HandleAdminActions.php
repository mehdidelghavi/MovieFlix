<?php

namespace App\Listeners\Dashboard;

use App\Events\Dashboard\AdminActions;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleAdminActions implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AdminActions $event): void
    {
        $data = $event->data;
        $action = $event->action;
        $model = $data['model'];
        $user = $data['causer'];
        $labels = [
            'user' => [
                'field' => 'email',
                'entity' => 'کاربر',
                'action_prefix' => 'User'
            ],
            'genre' => [
                'field'  => 'title',
                'entity' => 'ژانر',
                'action_prefix' => 'Genre'
            ],
            'actor' => [
                'field'  => 'name',
                'entity' => 'بازیگر',
                'action_prefix' => 'Actor'
            ],
            'article' => [
                'field'  => 'title',
                'entity' => 'مقاله',
                'action_prefix' => 'Article'
            ],
            'collection' => [
                'field'  => 'name',
                'entity' => 'کالکشن',
                'action_prefix' => 'Collection'
            ],
            'comment' => [
                'field'  => 'text',
                'entity' => 'نظر',
                'action_prefix' => 'Comment'
            ],
            'movie_list' => [
                'field'  => 'title',
                'entity' => 'لیست',
                'action_prefix' => 'Movie List'
            ],
            'movie' => [
                'field'  => 'slug',
                'entity' => 'فیلم / سریال',
                'action_prefix' => 'Movie'
            ],
            'newsletter' => [
                'field'  => 'title',
                'entity' => 'خبر نامه',
                'action_prefix' => 'Newsletter'
            ],
            'permission' => [
                'field'  => 'name',
                'entity' => 'مجوز',
                'action_prefix' => 'Permission'
            ],
            'plan' => [
                'field'  => 'title',
                'entity' => 'اشتراک',
                'action_prefix' => 'Plan'
            ],
            'requirement' => [
                'field'  => 'title',
                'entity' => 'آموزش / نیازمندی ها',
                'action_prefix' => 'Requirement'
            ],
            'role' => [
                'field'  => 'name',
                'entity' => 'نقش',
                'action_prefix' => 'Role'
            ],
            'setting' => [
                'field'  => 'id',
                'entity' => 'تنظیمات',
                'action_prefix' => 'Setting'
            ],
        ];
        $config = $labels[$event->model];
        $field  = $config['field'];
        $title  = $config['entity'];
        $prefix = $config['action_prefix'];
        $messages = [
            'create' => "{$title} {$model[$field]} ساخته شد",
            'update' => "{$title} {$model[$field]} به روز رسانی شد",
            'delete' => "{$title} {$model[$field]} حذف شد",
        ];
        $actionNames = [
            'create' => "{$prefix} Create",
            'update' => "{$prefix} Update",
            'delete' => "{$prefix} Delete",
        ];

        $message     = $messages[$action];
        $eventAction = $actionNames[$action];
        $user->logActivity('admin_activity', $eventAction, [
            'messages' => [
                $message
            ]
        ], $user->id, $model);
    }
}
