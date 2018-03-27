<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'laravel5-sample');

// Project repository
set('repository', 'https://toshiro3@github.com/toshiro3/laravel5-sample.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

//host('project.com')
//    ->set('deploy_path', '~/{{application}}');    

localhost()
    ->set('deploy_path', '/home/ec2-user/{{application}}')
    ->set('build_path', '{{deploy_path}}/build');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

task('update_code', function () {
    run("cp -Rf {{build_path}}/* {{release_path}}/");
});

desc('Deploy batch');
task('deploy_batch', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:view:clear',
    'artisan:cache:clear',
    'artisan:config:cache',
    'artisan:optimize',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
]);

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

