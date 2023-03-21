# Hub (extend git commands)
alias git=hub
 
# Directories
alias ll='ls -FGlAhp'
alias ..="cd ../"
alias ...="cd ../../"
alias ....="cd ../../../"
alias .....="cd ../../../../"
 
alias df="df -h"
alias diskusage="df"
alias fu="du -ch"
alias folderusage="fu"
alias tfu="du -sh"
alias totalfolderusage="tfu"
 
alias finder='open -a 'Finder' .'
 
# Vagrant
alias vagrantgo="vagrant up && vagrant ssh"
alias vgo="vagrantgo"
alias vhalt="vagrant halt"
alias vreload="vagrant reload && vgo"
 
# PHP
alias c='composer'
alias cr='composer require'
alias cda='composer dumpautoload'
alias co='composer outdated --direct'
alias update-global-composer='cd ~/.composer && composer update'
alias composer-update-global='update-global-composer'
 
alias a='php artisan'
alias pa='php artisan'
alias phpa='php artisan'
alias art='php artisan'
alias arti='php artisan'
 
alias test='vendor/bin/phpunit'
 
alias y='yarn'
alias yr='yarn run'
 
# Homestead
alias edithomestead='open -a "Visual Studio Code" ~/Homestead/Homestead.yaml'
alias homesteadedit='edithomestead'
alias dev-homestead='cd ~/Homestead && vgo'
alias homestead-update='cd ~/Homestead && vagrant box update && git pull origin master'
alias update-homestead='homestead-update'
 
# Various
alias editaliases='open -a "Visual Studio Code" ~/.bash_aliases'
alias showpublickey='cat ~/.ssh/id_ed25519.pub'
alias ip="curl icanhazip.com"
alias localip="ifconfig | grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -Eo '([0-9]*\.){3}[0-9]*' | grep -v '127.0.0.1'"
alias copy='rsync -avv --stats --human-readable --itemize-changes --progress --partial'
 