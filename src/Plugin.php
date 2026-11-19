<?php

namespace WpLab\AI;

use WpLab\AI\Admin\AdminPage;

class Plugin
{
    public function __construct(
        private AdminPage $adminPage,
        private Assets $assets
    ) {}

    public function run(): void
    {
        $this->adminPage->register();
        $this->assets->register();
    }
}