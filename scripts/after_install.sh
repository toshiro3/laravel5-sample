#!/bin/sh

build_path=/home/ec2-user/laravel5-sample/build

#mkdir -p $deploy_path/shared
#mv $deploy_path/releases/tmp $deploy_path/releases/$DEPLOYMENT_ID
#ln -nfs $deploy_path/releases/$DEPLOYMENT_ID $deploy_path/current

env
export PATH=$PATH:/usr/local/bin

cd $build_path
vendor/bin/dep deploy_batch
