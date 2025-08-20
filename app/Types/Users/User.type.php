<?php
namespace App\Types\Users;

/**
 * @phpstan-type UserShape array{
 *     id?: int|null,
 *     name: string,
 *     email: string,
 *     password: string,
 *     phone: string,
 *     avatar?: string|null,
 *     document: string,
 *     document_type: string,
 *     birthdate: string,
 *     status?: string|null,
 *     keyword?: string|null,
 *     email_sha256?: string|null,
 *     phone_sha256?: string|null,
 *     document_sha256?: string|null,
 *     system_key?: string|null,
 *     twof_secret?: string|null,
 * }
 */
