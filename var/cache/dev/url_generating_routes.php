<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    'pentatrion_vite_build_proxy' => [['path'], ['_controller' => 'Pentatrion\\ViteBundle\\Controller\\ViteController::proxyBuild'], ['path' => '.+'], [['variable', '/', '.+', 'path', true], ['text', '/build']], [], [], []],
    'app_vue' => [[], ['_controller' => 'App\\Controller\\VueController::index'], [], [['text', '/vue']], [], [], []],
    'test' => [[], ['_controller' => 'App\\Controller\\VueController::test'], [], [['text', '/vue/test']], [], [], []],
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
];