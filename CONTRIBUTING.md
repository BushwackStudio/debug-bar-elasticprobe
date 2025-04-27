# Contributing and Maintaining

First, thank you for taking the time to contribute!

The following is a set of guidelines for contributors as well as information and instructions around our maintenance process.  The two are closely tied together in terms of how we all work together and set expectations, so while you may not need to know everything in here to submit an issue or pull request, it's best to keep them in the same document.

## Ways to contribute

Contributing isn't just writing code - it's anything that improves the project.  All contributions are managed right here on GitHub.  Here are some ways you can help:

### Reporting bugs

If you're running into an issue, please take a look through [existing issues](https://github.com/BushwackStudio/debug-bar-wpprobe/issues) and [open a new one](https://github.com/BushwackStudio/debug-bar-wpprobe/issues/new?assignees=&labels=bug&template=1-bug-report.md&title=) if needed.  If you're able, include steps to reproduce, environment information, and screenshots/screencasts as relevant.

### Suggesting enhancements

New features and enhancements are also managed via [issues](https://github.com/BushwackStudio/debug-bar-wpprobe/issues).

### Pull requests

Pull requests represent a proposed solution to a specified problem.  They should always reference an issue that describes the problem and contains discussion about the problem itself.  Discussion on pull requests should be limited to the pull request itself, i.e. code review.

## Workflow

The `dev` branch is the development branch which means it contains the next version to be released.  `stable` contains the current latest release and `trunk` contains the corresponding stable development version.  Always work on the `dev` branch and open up PRs against `dev`.

## Release instructions

1. Branch: Starting from `dev`, cut a release branch named `release/X.Y.Z` for your changes.
2. Version bump: Bump the version number in `debug-bar-wpprobe.php`, `package.json`, `readme.txt`, and any other relevant files if it does not already reflect the version being released.  In `debug-bar-wpprobe.php` update both the plugin "Version:" property and the plugin `EP_DEBUG_VERSION` constant.
3. Changelog: Add/update the changelog in `CHANGELOG.md` and `readme.txt`, ensuring to link the [X.Y.Z] release reference in the footer of `CHANGELOG.md` (e.g., https://github.com/BushwackStudio/debug-bar-wpprobe/compare/X.Y.Z-1...X.Y.Z).
4. Props: Update `CREDITS.md` file with any new contributors, confirm maintainers are accurate.
5. Readme updates: Make any other readme changes as necessary.  `README.md` is geared toward GitHub and `readme.txt` contains WordPress.org-specific content.  The two are slightly different.
6. New files: Check to be sure any new files/paths that are unnecessary in the production version are included in `.gitattributes`.
7. POT file: Run `wp i18n make-pot . lang/debug-bar-wpprobe.pot` and commit the file.
8. Release date: Double check the release date in both changelog files.
9. Merge: Merge the release branch/PR into `dev`, then make a non-fast-forward merge from `dev` into `trunk` (`git checkout trunk && git merge --no-ff dev`).  `trunk` contains the stable development version.
10. Test: While still on the `trunk` branch, test for functionality locally.
11. Push: Push your `trunk` branch to GitHub (e.g. `git push origin trunk`).
12. Release: Create a [new release](https://github.com/BushwackStudio/debug-bar-wpprobe/releases/new), naming the tag and the release with the new version number, and targeting the `trunk` branch.  Paste the release changelog from `CHANGELOG.md` into the body of the release and include a link to the closed issues on the [milestone](https://github.com/BushwackStudio/debug-bar-wpprobe/milestone/#?closed=1).
13. SVN: Wait for the [GitHub Action](https://github.com/BushwackStudio/debug-bar-wpprobe/actions?query=workflow%3A%22Deploy+to+WordPress.org%22) to finish deploying to the WordPress.org repository.  If all goes well, users with SVN commit access for that plugin will receive an emailed diff of changes.
14. Check WordPress.org: Ensure that the changes are live on https://github.com/BushwackStudio/debug-bar-wpprobe/.  This may take a few minutes.
15. Close milestone: Edit the [milestone](https://github.com/BushwackStudio/debug-bar-wpprobe/milestone/#) with release date (in the `Due date (optional)` field) and link to GitHub release (in the `Description` field), then close the milestone.
16. Punt incomplete items: If any open issues or PRs which were milestoned for `X.Y.Z` do not make it into the release, update their milestone to `X.Y.Z+1`, `X.Y+1.0`, `X+1.0.0` or `Future Release`.

## Hotfix release instructions

There may be cases where we have an urgent/important fix that ideally gets into a release quickly without any other changes (e.g., a "hotfix") so as to reduce (1) the amount or testing before being confident in the release and (2) to reduce the chance of unintended side effects from the extraneous non-urgent/important changes.  In cases where code has previously been merged into `dev` but that ideally is not part of a hotfix, the normal release instructions above will not suffice as they would release all code merged to `dev` alongside the intended urgent/important "hotfix" change(s).  In case of needing to release a "hotfix" the following are the recommended steps to take.

1. Branch: Starting from `trunk`, cut a hotfix release branch named `hotfix/X.Y.Z` for your hotfix change(s).
1. Version bump: Bump the version number in `debug-bar-wpprobe.php`, `package.json`, `readme.txt`, and any other relevant files if it does not already reflect the version being released.  In `debug-bar-wpprobe.php` update both the plugin "Version:" property and the plugin `EP_DEBUG_VERSION` constant.
1. Changelog: Add/update the changelog in `CHANGELOG.md` and `readme.txt`, ensuring to link the [X.Y.Z] release reference in the footer of `CHANGELOG.md` (e.g., https://github.com/BushwackStudio/debug-bar-wpprobe/compare/X.Y.Z-1...X.Y.Z).
1. Props: Update `CREDITS.md` file with any new contributors, confirm maintainers are accurate.
1. Readme updates: Make any other readme changes as necessary.  `README.md` is geared toward GitHub and `readme.txt` contains WordPress.org-specific content.  The two are slightly different.
1. New files: Check to be sure any new files/paths that are unnecessary in the production version are included in `.gitattributes`.
1. POT file: Run `wp i18n make-pot . lang/debug-bar-wpprobe.pot` and commit the file.
1. Release date: Double check the release date in both changelog files.
1. Merge: Merge the release branch/PR into `trunk`.  `trunk` contains the stable development version.
1. Test: While still on the `trunk` branch, test for functionality locally.
1. Push: Push your `trunk` branch to GitHub (e.g. `git push origin trunk`).
1. Release: Create a [new release](https://github.com/BushwackStudio/debug-bar-wpprobe/releases/new), naming the tag and the release with the new version number, and targeting the `trunk` branch.  Paste the release changelog from `CHANGELOG.md` into the body of the release and include a link to the closed issues on the [milestone](https://github.com/BushwackStudio/debug-bar-wpprobe/milestone/#?closed=1).
1. SVN: Wait for the [GitHub Action](https://github.com/BushwackStudio/debug-bar-wpprobe/actions?query=workflow%3A%22Deploy+to+WordPress.org%22) to finish deploying to the WordPress.org repository.  If all goes well, users with SVN commit access for that plugin will receive an emailed diff of changes.
1. Check WordPress.org: Ensure that the changes are live on https://wordpress.org/plugins/wpprobe/.  This may take a few minutes.
1. Close milestone: Edit the [milestone](https://github.com/BushwackStudio/debug-bar-wpprobe/milestone/#) with release date (in the `Due date (optional)` field) and link to GitHub release (in the `Description` field), then close the milestone.
1. Punt incomplete items: If any open issues or PRs which were milestoned for `X.Y.Z` do not make it into the hotfix release, update their milestone to `X.Y.Z+1`, `X.Y+1.0`, `X+1.0.0` or `Future Release`.
1. Apply hotfix changes to `dev`: Make a non-fast-forward merge from `trunk` into `dev` (`git checkout dev && git merge --no-ff trunk`) to ensure your hotfix change(s) are in sync with active development.
