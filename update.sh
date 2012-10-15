#!/bin/bash


find . -mtime -1 -exec scp -p '{}' web:~/public_html/ \;
