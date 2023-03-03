#!/bin/sh

./bin/ffmpeg -i $1 -frames:v 1 -y ./img/img$2.jpg 2>/dev/null

#
