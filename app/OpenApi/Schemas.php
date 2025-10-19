<?php

namespace App\OpenApi;

/**
 * @OA\Schema(
 *   schema="Post",
 *   type="object",
 *   required={"id","title","link","description","pub_date","created_at","updated_at"},
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="title", type="string", example="Sample title"),
 *   @OA\Property(property="link", type="string", format="uri", example="https://lifehacker.com/xyz"),
 *   @OA\Property(property="description", type="string", example="<p>HTML or text…</p>"),
 *   @OA\Property(property="pub_date", type="string", example="Sat, 18 Oct 2025 21:30:00 +0000"),
 *   @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-18T20:55:56Z"),
 *   @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-18T20:55:56Z")
 * )
 *
 * @OA\Schema(
 *   schema="PaginationMeta",
 *   type="object",
 *   @OA\Property(property="current_page", type="integer", example=1),
 *   @OA\Property(property="per_page", type="integer", example=15),
 *   @OA\Property(property="total", type="integer", example=123),
 *   @OA\Property(property="last_page", type="integer", example=9)
 * )
 *
 * @OA\Schema(
 *   schema="SuccessWrapperPost",
 *   type="object",
 *   required={"success","data"},
 *   @OA\Property(property="success", type="boolean", example=true),
 *   @OA\Property(property="data", ref="#/components/schemas/Post")
 * )
 *
 * @OA\Schema(
 *   schema="SuccessWrapperPosts",
 *   type="object",
 *   required={"success","data","meta"},
 *   @OA\Property(property="success", type="boolean", example=true),
 *   @OA\Property(
 *     property="data",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/Post")
 *   ),
 *   @OA\Property(property="meta", ref="#/components/schemas/PaginationMeta")
 * )
 *
 * @OA\Schema(
 *   schema="SuccessMessage",
 *   type="object",
 *   required={"success","message"},
 *   @OA\Property(property="success", type="boolean", example=true),
 *   @OA\Property(property="message", type="string", example="Post deleted successfully")
 * )
 *
 * @OA\Schema(
 *   schema="PostCreateRequest",
 *   type="object",
 *   required={"title","link"},
 *   @OA\Property(property="title", type="string", example="New Article"),
 *   @OA\Property(property="link", type="string", format="uri", example="https://example.com/new-article"),
 *   @OA\Property(property="description", type="string", example="<p>HTML…</p>"),
 *   @OA\Property(property="pub_date", type="string", example="Sat, 18 Oct 2025 21:30:00 +0000")
 * )
 *
 * @OA\Schema(
 *   schema="PostUpdateRequest",
 *   type="object",
 *   @OA\Property(property="title", type="string"),
 *   @OA\Property(property="link", type="string", format="uri"),
 *   @OA\Property(property="description", type="string"),
 *   @OA\Property(property="pub_date", type="string")
 * )
 *
 * @OA\Schema(
 *      schema="ErrorResponse",
 *      type="object",
 *      @OA\Property(property="success", type="boolean", example=false),
 *      @OA\Property(property="message", type="string", example="No results found")
 * )
 *
 * @OA\Schema(
 *    schema="ValidationErrorResponse",
 *    type="object",
 *    required={"message","errors"},
 *    @OA\Property(property="message", type="string", example="The title field is required."),
 *    @OA\Property(
 *      property="errors",
 *      type="object",
 *      additionalProperties=@OA\Schema(
 *        type="array",
 *        @OA\Items(type="string")
 *      ),
 *      example={"title": {"The title field is required."}}
 *    )
 * )
 */
class Schemas
{

}
