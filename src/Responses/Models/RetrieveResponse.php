<?php

declare(strict_types=1);

namespace OpenAI\Responses\Models;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Contracts\ResponseHasMetaInformationContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Responses\Concerns\HasMetaInformation;
use OpenAI\Responses\Meta\MetaInformation;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, created: int, owned_by: string, permission: array<int, array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}>, root: string, parent: ?string}>
 */
final class RetrieveResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @readonly
     */
    public string $id;
    /**
     * @readonly
     */
    public string $object;
    /**
     * @readonly
     */
    public int $created;
    /**
     * @readonly
     */
    public string $ownedBy;
    /**
     * @var array<int, RetrieveResponsePermission>
     * @readonly
     */
    public array $permission;
    /**
     * @readonly
     */
    public string $root;
    /**
     * @readonly
     */
    public ?string $parent;
    /**
     * @readonly
     */
    private MetaInformation $meta;
    /**
     * @use ArrayAccessible<array{id: string, object: string, created: int, owned_by: string, permission: array<int, array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}>, root: string, parent: ?string}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, RetrieveResponsePermission>  $permission
     */
    private function __construct(string $id, string $object, int $created, string $ownedBy, array $permission, string $root, ?string $parent, MetaInformation $meta)
    {
        $this->id = $id;
        $this->object = $object;
        $this->created = $created;
        $this->ownedBy = $ownedBy;
        $this->permission = $permission;
        $this->root = $root;
        $this->parent = $parent;
        $this->meta = $meta;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, created: int, owned_by: string, permission: array<int, array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}>, root: string, parent: ?string}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $permission = array_map(fn (array $result): RetrieveResponsePermission => RetrieveResponsePermission::from(
            $result
        ), $attributes['permission']);

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created'],
            $attributes['owned_by'],
            $permission,
            $attributes['root'],
            $attributes['parent'],
            $meta,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'created' => $this->created,
            'owned_by' => $this->ownedBy,
            'permission' => array_map(
                static fn (RetrieveResponsePermission $result): array => $result->toArray(),
                $this->permission,
            ),
            'root' => $this->root,
            'parent' => $this->parent,
        ];
    }
}
