@echo off
# Hub (extend git commands)
DOSKEY git=hub
 
# Directories
DOSKEY ll='ls -FGlAhp'
DOSKEY ..="cd ../"
DOSKEY ...="cd ../../"
DOSKEY ....="cd ../../../"
DOSKEY .....="cd ../../../../"
 
DOSKEY df="df -h"
DOSKEY diskusage="df"
DOSKEY fu="du -ch"
DOSKEY folderusage="fu"
DOSKEY tfu="du -sh"
DOSKEY totalfolderusage="tfu"
 
DOSKEY finder='open -a 'Finder' .'
 
# Vagrant
DOSKEY vagrantgo="vagrant up && vagrant ssh"
DOSKEY vgo="vagrantgo"
DOSKEY vhalt="vagrant halt"
DOSKEY vreload="vagrant reload && vgo"
 
# PHP
DOSKEY c='composer'
DOSKEY cr='composer require'
DOSKEY cda='composer dumpautoload'
DOSKEY co='composer outdated --direct'
DOSKEY update-global-composer='cd ~/.composer && composer update'
DOSKEY composer-update-global='update-global-composer'
 
DOSKEY a='php artisan'
DOSKEY pa='php artisan'
DOSKEY phpa='php artisan'
DOSKEY art='php artisan'
DOSKEY arti='php artisan'
 
DOSKEY test='vendor/bin/phpunit'
 
DOSKEY y='yarn'
DOSKEY yr='yarn run'
 
# Homestead
DOSKEY edithomestead='open -a "Visual Studio Code" ~/Homestead/Homestead.yaml'
DOSKEY homesteadedit='edithomestead'
DOSKEY dev-homestead='cd ~/Homestead && vgo'
DOSKEY homestead-update='cd ~/Homestead && vagrant box update && git pull origin master'
DOSKEY update-homestead='homestead-update'
 
# Various
DOSKEY editaliases='open -a "Visual Studio Code" ~/.bash_aliases'
DOSKEY showpublickey='cat ~/.ssh/id_ed25519.pub'
DOSKEY ip="curl icanhazip.com"
DOSKEY localip="ifconfig | grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -Eo '([0-9]*\.){3}[0-9]*' | grep -v '127.0.0.1'"
DOSKEY copy='rsync -avv --stats --human-readable --itemize-changes --progress --partial'
 