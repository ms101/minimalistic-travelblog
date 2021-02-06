#!/bin/bash
# convert *.JPG to 1200px width +quality=67%
# dependency: ImageMagick

# argument given?
if [ $# -lt 1 ]
then
   echo "usage: $0 [path to JPGs]"
   echo "converts all JPGs in path to 1200px width and 67% quality"
   exit 1
fi

# load JPGs & convert
for jpg in "$1"/*
do
	ext="${jpg##*.}"

	if ([ $ext == "jpg" ] || [ $ext == "JPG" ])
	then
		convert "$jpg" -resize 1200 -quality 67 "$jpg"
		echo "$jpg converted."
	else
		echo "$jpg ist not a JPG."
	fi
done
