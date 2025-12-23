<?php
    $navItems = [
        [
            'label' => 'Dashboard',
            'route' => 'admin.dashboard',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
        ],
        [
            'label' => 'Hero Slides',
            'route' => 'admin.hero.index',
            'pattern' => 'admin.hero*',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
        ],
        [
            'label' => 'Pages',
            'route' => 'admin.pages.index',
            'pattern' => 'admin.pages*',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
        ],
        [
            'label' => 'Categories',
            'route' => 'admin.categories.index',
            'pattern' => 'admin.categories*',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>',
        ],
        [
            'label' => 'Products',
            'route' => 'admin.products.index',
            'pattern' => 'admin.products*',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>',
        ],
        [
            'label' => 'Process Steps',
            'route' => 'admin.process-steps.index',
            'pattern' => 'admin.process-steps*',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>',
        ],
        [
            'label' => 'Posts',
            'route' => 'admin.posts.index',
            'pattern' => 'admin.posts*',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>',
        ],
        [
            'label' => 'Partners',
            'route' => 'admin.partners.index',
            'pattern' => 'admin.partners*',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
        ],
        [
            'label' => 'Distributor Requests',
            'route' => 'admin.distributor-requests.index',
            'pattern' => 'admin.distributor-requests*',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"/>',
        ],
        [
            'label' => 'Media Library',
            'route' => 'admin.media.index',
            'pattern' => 'admin.media*',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
        ],
    ];

    $adminItems = [
        [
            'label' => 'Users',
            'route' => 'admin.users.index',
            'pattern' => 'admin.users*',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
        ],
        [
            'label' => 'Roles',
            'route' => 'admin.roles.index',
            'pattern' => 'admin.roles*',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
        ],
        [
            'label' => 'Settings',
            'route' => 'admin.settings.index',
            'pattern' => 'admin.settings*',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>',
        ],
    ];
?>

<ul class="space-y-1">
    
    <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $isActive = request()->routeIs($item['pattern'] ?? $item['route'] . '*');
        ?>
        <li>
            <a
                href="<?php echo e(route($item['route'])); ?>"
                class="group flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200
                    <?php echo e($isActive
                        ? 'bg-green-600 text-white'
                        : 'text-gray-300 hover:bg-gray-800 hover:text-white'); ?>"
            >
                <svg class="w-5 h-5 flex-shrink-0 <?php echo e($isActive ? 'text-white' : 'text-gray-400 group-hover:text-white'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <?php echo $item['icon']; ?>

                </svg>
                <span><?php echo e($item['label']); ?></span>
            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>


<?php if(auth()->user() && auth()->user()->hasRole('admin')): ?>
    <div class="mt-6 pt-6 border-t border-gray-800">
        <p class="px-3 mb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
            Administration
        </p>
        <ul class="space-y-1">
            <?php $__currentLoopData = $adminItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $isActive = request()->routeIs($item['pattern'] ?? $item['route'] . '*');
                ?>
                <li>
                    <a
                        href="<?php echo e(route($item['route'])); ?>"
                        class="group flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200
                            <?php echo e($isActive
                                ? 'bg-green-600 text-white'
                                : 'text-gray-300 hover:bg-gray-800 hover:text-white'); ?>"
                    >
                        <svg class="w-5 h-5 flex-shrink-0 <?php echo e($isActive ? 'text-white' : 'text-gray-400 group-hover:text-white'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <?php echo $item['icon']; ?>

                        </svg>
                        <span><?php echo e($item['label']); ?></span>
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>


<!-- <div class="mt-6 pt-6 border-t border-gray-800">
    <a
        href="<?php echo e(url('/')); ?>"
        target="_blank"
        class="group flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-all duration-200"
    >
        <svg class="w-5 h-5 flex-shrink-0 text-gray-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
        </svg>
        <span>View Site</span>
    </a>
</div> -->
<?php /**PATH C:\dev\projects\web\sofood\resources\views/admin/partials/_sidebar-nav.blade.php ENDPATH**/ ?>