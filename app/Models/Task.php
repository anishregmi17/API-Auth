<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Task",
 *     type="object",
 *     required={"title", "description"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Unique identifier for the task",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="Title of the task",
 *         example="Complete Laravel API"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="Description of the task",
 *         example="Build and document a Laravel task management API"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp when the task was created",
 *         example="2024-09-22T12:34:56Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Timestamp when the task was last updated",
 *         example="2024-09-22T12:35:56Z"
 *     )
 * )
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];
}
