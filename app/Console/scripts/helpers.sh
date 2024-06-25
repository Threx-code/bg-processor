#!/bin/bash

log() {
    COLOR="\033[42m\033[30m"

    if (( $# == 2 )) ; then
        case "$1" in
            notice)
            ;;
            warning)
                COLOR="\033[43m"
            ;;
            error)
                COLOR="\033[41m"
            ;;
        esac

        MESSAGE=$2
    else
        MESSAGE=$1
    fi

    echo -e "${COLOR}${MESSAGE}\033[0m"
}
