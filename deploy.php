<?php
namespace Deployer;

require 'recipe/symfony.php';

// Project name
set('application', 'demo-deployer');

// Project repository
set('repository', 'git@github.com:dariusclinton/demo-deployer.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);

set('writable_dirs', array_merge(get('writable_dirs'), [
    'web/uploads',
]));

set('git_recursive', false);

set('deploy:assetic:dump', function() {
	run('{{bin/console}} assetic:dump {{console_options}}');
});


// Hosts

host('production')
	->hostname('127.0.0.1')
    ->set('deploy_path', '~/Workspace/public_html_demo/{{application}}')
	->set('shared_files', [])
	->set('http_user', 'www-data');
    ;    

host('test')
	->hostname('127.0.0.1')
    ->set('deploy_path', '~/Workspace/public_html_demo/test/{{application}}')
	->set('shared_files', [])
	->set('http_user', 'www-data')
    ;    

after('deploy', 'deploy:done');
    
// Tasks

task('deploy:done', 'dep list');

task('build', function () {
    run('cd {{release_path}} && build');
});

// task('deploy:update_code', function () {
//     upload('.', '{{release_path}}');
// });


// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');

