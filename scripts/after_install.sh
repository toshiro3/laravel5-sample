#!/bin/sh

deploy_path=/home/ec2-user/laravel5-sample

mkdir -p $deploy_path/shared
mv $deploy_path/releases/tmp $deploy_path/releases/$DEPLOYMENT_ID
ln -nfs $deploy_path/releases/$DEPLOYMENT_ID $deploy_path/current
