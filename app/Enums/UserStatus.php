<?php

namespace App\Enums;

/**
 * Enum class for UserStatus.
 * Represents the status of a user.
 */
enum UserStatus: int
{
    case ACTIVE = 1;
    case INACTIVE = 0;

    /**
     * Convert the UserStatus enum values to an array.
     *
     * @return array The array representation of the UserStatus enum values.
     */
    public static function toArray(): array
    {
        return [
            [
                'id' => self::ACTIVE->value,
                'name' => __('modules/user.status.active'),
            ],
            [
                'id' => self::INACTIVE->value,
                'name' => __('modules/user.status.inactive'),
            ],
        ];
    }

    /**
     * Returns the label corresponding to the given user status.
     *
     * @param int $status The user status.
     * @return string The label corresponding to the user status.
     */
    public static function getLabel($status): string
    {
        $status = (int) $status;
        return match ($status) {
            self::ACTIVE->value => __('modules/user.status.active'),
            self::INACTIVE->value => __('modules/user.status.inactive'),
            default => '',
        };
    }

    /**
     * Get the status ID based on the status name.
     *
     * @param string $statusName The name of the status.
     * @return int The ID of the status.
     */
    public static function getStatusIdByName($statusName): int
    {
        return match ($statusName) {
            __('modules/user.status.active') => self::ACTIVE->value,
            __('modules/user.status.inactive') => self::INACTIVE->value,
            default => self::INACTIVE->value,
        };
    }

    /**
     * Check if the user status is active.
     *
     * @return bool Returns true if the user status is active, false otherwise.
     */
    public function isActive(): bool
    {
        return $this === self::ACTIVE;
    }

    /**
     * Check if the user status is inactive.
     *
     * @return bool Returns true if the user status is inactive, false otherwise.
     */
    public function isInactive(): bool
    {
        return $this === self::INACTIVE;
    }

    /**
     * Returns the HTML representation of the label for the user status.
     *
     * @return string The HTML code for the label.
     */
    public function getLabelHtml(): string
    {
        return sprintf('<span class="rounded-pill content-status font-weight-bold %s">%s</span>', $this->getLabelColor(), $this->getLabelText());
    }

    /**
     * Get the label color based on the user status.
     *
     * @return string The CSS classes for the label color.
     */
    public function getLabelColor(): string
    {
        return match ($this) {
            self::ACTIVE => 'bg-success color-success',
            self::INACTIVE => 'bg-danger color-danger',
        };
    }

    /**
     * Returns the label text for the user status.
     *
     * @return string The label text.
     */
    public function getLabelText(): string
    {
        return match ($this) {
            self::ACTIVE => __('modules/user.status.active'),
            self::INACTIVE => __('modules/user.status.inactive'),
        };
    }
}
