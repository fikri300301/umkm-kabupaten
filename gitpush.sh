#!/bin/bash

commit_description=""
branch_name=""

# Parse command line arguments
while [[ $# -gt 0 ]]; do
key="$1"

case $key in
--c)
commit_description="$2"
shift
shift
;;
--b)
branch_name="$2"
shift
shift
;;
*)
echo "Unknown option: $key"
exit 1
;;
esac
done

# Check if commit description and branch name are provided
if [ -z "$commit_description" ] || [ -z "$branch_name" ]; then
echo "Usage: ./gitpush.sh --c 'commit description' --b 'branch name'"
exit 1
fi

# Add changes, commit, and push
git add .
git commit -m "$commit_description"
git push origin "$branch_name"
