<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['id' => 6, 'name' => 'vendor-condition.index', 'guard_name' => 'admin', 'group_name' => 'manage_vendors'],
            ['id' => 7, 'name' => 'vendor-request.index', 'guard_name' => 'admin', 'group_name' => 'manage_vendors'],
            ['id' => 8, 'name' => 'vendor-request.edit', 'guard_name' => 'admin', 'group_name' => 'manage_vendors'],
            ['id' => 9, 'name' => 'vendor-request.delete', 'guard_name' => 'admin', 'group_name' => 'manage_vendors'],
            ['id' => 10, 'name' => 'approve-vendors.index', 'guard_name' => 'admin', 'group_name' => 'manage_vendors'],
            ['id' => 11, 'name' => 'approve-vendors.edit', 'guard_name' => 'admin', 'group_name' => 'manage_vendors'],
            ['id' => 12, 'name' => 'approve-vendrors.delete', 'guard_name' => 'admin', 'group_name' => 'manage_vendors'],
            ['id' => 13, 'name' => 'withdraw-method.index', 'guard_name' => 'admin', 'group_name' => 'manage_vendors'],
            ['id' => 14, 'name' => 'withdraw-method.create', 'guard_name' => 'admin', 'group_name' => 'manage_vendors'],
            ['id' => 15, 'name' => 'withdraw-method.edit', 'guard_name' => 'admin', 'group_name' => 'manage_vendors'],
            ['id' => 16, 'name' => 'withdraw-method.delete', 'guard_name' => 'admin', 'group_name' => 'manage_vendors'],
            ['id' => 17, 'name' => 'withdraw-request.index', 'guard_name' => 'admin', 'group_name' => 'manage_vendors'],
            ['id' => 18, 'name' => 'withdraw-request.view', 'guard_name' => 'admin', 'group_name' => 'manage_vendors'],
            ['id' => 19, 'name' => 'user.index', 'guard_name' => 'admin', 'group_name' => 'manage_users'],
            ['id' => 20, 'name' => 'user.edit', 'guard_name' => 'admin', 'group_name' => 'manage_users'],
            ['id' => 21, 'name' => 'user.delete', 'guard_name' => 'admin', 'group_name' => 'manage_users'],
            ['id' => 22, 'name' => 'admin.index', 'guard_name' => 'admin', 'group_name' => 'manage_admins'],
            ['id' => 23, 'name' => 'admin.edit', 'guard_name' => 'admin', 'group_name' => 'manage_admins'],
            ['id' => 24, 'name' => 'admin.delete', 'guard_name' => 'admin', 'group_name' => 'manage_admins'],
            ['id' => 25, 'name' => 'category.index', 'guard_name' => 'admin', 'group_name' => 'manage_category'],
            ['id' => 26, 'name' => 'category.create', 'guard_name' => 'admin', 'group_name' => 'manage_category'],
            ['id' => 27, 'name' => 'category.edit', 'guard_name' => 'admin', 'group_name' => 'manage_category'],
            ['id' => 28, 'name' => 'category.delete', 'guard_name' => 'admin', 'group_name' => 'manage_category'],
            ['id' => 29, 'name' => 'sub-category.index', 'guard_name' => 'admin', 'group_name' => 'manage_category'],
            ['id' => 30, 'name' => 'sub-category.create', 'guard_name' => 'admin', 'group_name' => 'manage_category'],
            ['id' => 31, 'name' => 'sub-category.edit', 'guard_name' => 'admin', 'group_name' => 'manage_category'],
            ['id' => 32, 'name' => 'sub-category.delete', 'guard_name' => 'admin', 'group_name' => 'manage_category'],
            ['id' => 33, 'name' => 'child-category.index', 'guard_name' => 'admin', 'group_name' => 'manage_category'],
            ['id' => 34, 'name' => 'child-category.create', 'guard_name' => 'admin', 'group_name' => 'manage_category'],
            ['id' => 35, 'name' => 'child-category.edit', 'guard_name' => 'admin', 'group_name' => 'manage_category'],
            ['id' => 36, 'name' => 'child-category.delete', 'guard_name' => 'admin', 'group_name' => 'manage_category'],
            ['id' => 37, 'name' => 'slider.index', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 38, 'name' => 'slider.create', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 39, 'name' => 'slider.edit', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 40, 'name' => 'slider.delete', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 41, 'name' => 'brands.index', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 42, 'name' => 'brands.create', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 43, 'name' => 'brands.edit', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 44, 'name' => 'brands.delete', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 45, 'name' => 'flash-sale.index', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 46, 'name' => 'flash-sale.edit', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 47, 'name' => 'flash-sale.delete', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 48, 'name' => 'top-category.edit', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 49, 'name' => 'single-category.edit', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 50, 'name' => 'shipping-rule.index', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 51, 'name' => 'shipping-rule.create', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 53, 'name' => 'shipping-rule.edit', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 54, 'name' => 'shipping-rule.delete', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 55, 'name' => 'ad.edit', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 56, 'name' => 'footer.edit', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 57, 'name' => 'newsletter.index', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 58, 'name' => 'newsletter.delete', 'guard_name' => 'admin', 'group_name' => 'manage_sections'],
            ['id' => 59, 'name' => 'about-page.edit', 'guard_name' => 'admin', 'group_name' => 'manage_pages'],
            ['id' => 60, 'name' => 'terms-page.edit', 'guard_name' => 'admin', 'group_name' => 'manage_pages'],
            ['id' => 61, 'name' => 'my-product.index', 'guard_name' => 'admin', 'group_name' => 'manage_products'],
            ['id' => 62, 'name' => 'my-product.edit', 'guard_name' => 'admin', 'group_name' => 'manage_products'],
            ['id' => 63, 'name' => 'my-product.delete', 'guard_name' => 'admin', 'group_name' => 'manage_products'],
            ['id' => 64, 'name' => 'vendor-product.index', 'guard_name' => 'admin', 'group_name' => 'manage_products'],
            ['id' => 65, 'name' => 'vendor-product.edit', 'guard_name' => 'admin', 'group_name' => 'manage_products'],
            ['id' => 66, 'name' => 'vendor-product.delete', 'guard_name' => 'admin', 'group_name' => 'manage_products'],
            ['id' => 67, 'name' => 'coupon.index', 'guard_name' => 'admin', 'group_name' => 'manage_coupons'],
            ['id' => 68, 'name' => 'coupon.edit', 'guard_name' => 'admin', 'group_name' => 'manage_coupons'],
            ['id' => 69, 'name' => 'coupon.delete', 'guard_name' => 'admin', 'group_name' => 'manage_coupons'],
            ['id' => 70, 'name' => 'review.index', 'guard_name' => 'admin', 'group_name' => 'manage_reviews'],
            ['id' => 71, 'name' => 'review.edit', 'guard_name' => 'admin', 'group_name' => 'manage_reviews'],
            ['id' => 72, 'name' => 'review.delete', 'guard_name' => 'admin', 'group_name' => 'manage_reviews'],
            ['id' => 73, 'name' => 'order.index', 'guard_name' => 'admin', 'group_name' => 'manage_orders'],
            ['id' => 74, 'name' => 'order.view', 'guard_name' => 'admin', 'group_name' => 'manage_orders'],
            ['id' => 75, 'name' => 'order.delete', 'guard_name' => 'admin', 'group_name' => 'manage_orders'],
            ['id' => 76, 'name' => 'transaction.index', 'guard_name' => 'admin', 'group_name' => 'manage_orders'],
            ['id' => 77, 'name' => 'general-settings.index', 'guard_name' => 'admin', 'group_name' => 'manage_settings'],
            ['id' => 78, 'name' => 'payment-settings.index', 'guard_name' => 'admin', 'group_name' => 'manage_settings'],
            ['id' => 79, 'name' => 'smtp-settings.index', 'guard_name' => 'admin', 'group_name' => 'manage_settings'],
            ['id' => 80, 'name' => 'maintainance.index', 'guard_name' => 'admin', 'group_name' => 'manage_settings'],
            ['id' => 81, 'name' => 'permission.index', 'guard_name' => 'admin', 'group_name' => 'manage_roles_and_permissions'],
            ['id' => 82, 'name' => 'permission.edit', 'guard_name' => 'admin', 'group_name' => 'manage_roles_and_permissions'],
            ['id' => 83, 'name' => 'permission.delete', 'guard_name' => 'admin', 'group_name' => 'manage_roles_and_permissions'],
        ];
        Permission::insert($permissions);
    }
}
