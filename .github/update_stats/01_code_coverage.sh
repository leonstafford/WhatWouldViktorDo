#!/bin/sh

echo "repo's script"
echo "r1 $NEW_COVERAGE"
echo "r2 ${{ env.NEW_COVERAGE }}"


# replace code coverage % in README into temp file
cat README.md | sed "/Coverage:/ c Coverage: $NEW_COVERAGE" | sed 's/\x1b\[[0-9;]*m//g' > NEWREADME.md

# overwrite README with tempfile
mv NEWREADME.md README.md
