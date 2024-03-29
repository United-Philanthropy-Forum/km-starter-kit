### For the PR creator:
Check off the following boxes before asking someone to review this PR.

- [ ] Update the "How to test this branch" instructions below by replacing `[the-branch]` with the name of this branch, and 
`[the-new-project]` with an example project name.

### What this PR does:
- [ ] *Fill this out.*

### How to test this branch:
- [ ] If you haven't already, run the [One time setup steps](https://github.com/United-Philanthropy-Forum/km-starter-kit/wiki/How-to-test-changes-to-this-starter-kit#one-time)
- [ ] Run this:

```yaml
COMPOSER_MEMORY_LIMIT=-1 terminus build:project:create --team='United Philanthropy Forum' --org='United-Philanthropy-Forum' --visibility='private' --stability=dev "united-philanthropy-forum/km-starter-kit:dev-[the-branch]" [the-new-project]
```

- [ ] Validate that a new site exists at https://dev-[the-new-project].pantheonsite.io
- [ ] Validate the repo exists at https://github.com/United-Philanthropy-Forum/[the-new-project]
- [ ] Delete the test environment when you're done, by running `terminus build:env:obliterate [the-new-project]`
- [ ] Once this PR is merged, cut a new tag so the `create-project` commands will get the latest and greatest.
