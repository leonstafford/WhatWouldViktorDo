#!/bin/sh

echo "Debug:"
echo "a shell script within .github/update_stats/"
echo "we have access to the variable set within our GH action yml: $NEW_COVERAGE"

# replace code coverage % in README into temp file
sed -i 's/Coverage:.*/Coverage: '"$NEW_COVERAGE"'/;s/\x1b\[[0-9;]*m//g' README.md

# TODO: optionally check for changes, annotate with "increased/decreased" compared to last build, etc
# or report when no project stats have changed, maybe exit code form this can determine if subsequent commit action takes place?

