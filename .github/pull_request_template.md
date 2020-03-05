### For the PR creator:
Check off the following boxes before asking someone to review this PR.

- [ ] If this PR changes the `composer.json` file, is there accompanying text in the `README.md` file explaining that change?
- [ ] Update the "How to test this branch" instructions below by replacing `[the-branch]` with the name of this branch, and 
`[the-new-project]` with an example project name.

### What this PR does:
- [ ] *Fill this out.*

### How to test this branch:
- [ ] If you haven't already, run the [One time setup steps](https://github.com/United-Philanthropy-Forum/km-starter-kit/wiki/How-to-test-changes-to-this-starter-kit#one-time)
- [ ] Run this:

```yaml
terminus build:project:create --team='United Philanthropy Forum' --org='United-Philanthropy-Forum' --visibility='private' --stability=dev "united-philanthropy-forum/km-starter-kit:dev-[the-branch]  [the-new-project]
```

dev-[new-project-name].pantheonsite.io
- [ ] Validate that a new site exists at `dev-[new-project-name].pantheonsite.io`
- [ ] Validate the repo exists at https://github.com/United-Philanthropy-Forum/`[new-project-name]`
- [ ] Delete the test environment when you're done, by running `terminus build:env:obliterate [new-project-name]`
