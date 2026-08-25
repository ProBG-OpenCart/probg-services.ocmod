# Documentation and release policy

Documentation is part of every development stage and is updated in the same change set as the code.

## Documentation requirements

For every completed change or stage:

1. Update `README.md` when user-visible capabilities, installation or configuration change.
2. Update `CHANGELOG.md` with every added, changed, fixed, deprecated, security-related or compatibility change included in the version.
3. Update `docs/DEVELOPMENT_PLAN.md` with completed and remaining work.
4. Update the administration **Features** tab when the implemented feature set or version changes.
5. Update architecture and database documents whenever structures or design decisions change.
6. Add or revise installation, upgrade, configuration, usage and testing notes as applicable.
7. Keep Bulgarian and English administration and storefront language files synchronized.
8. Record compatibility differences between OpenCart 3 and OpenCart 4.
9. Document migration steps before changing existing database structures or setting keys.
10. Record known limitations and deferred work honestly.

No stage is considered complete until its documentation is current.

## Mandatory release workflow for every PR

Every development PR for ProBG Services must finish with a complete release cycle after the changes are validated:

1. Work is made on a feature/fix branch and committed with appropriate Conventional Commit-style messages.
2. The PR must contain all code and documentation for the version, including the complete `CHANGELOG.md` entry.
3. The version number must be updated consistently in all module metadata and user-visible version locations.
4. An installable OpenCart OCMOD package must be generated in `dist/` for that exact version.
5. `dist/SHA256SUMS` must be updated for the generated package.
6. The PR is merged automatically once the intended change set and required checks are complete.
7. A Git tag is created from the merged commit using `v<version>`.
8. A GitHub Release is created for that tag/version.
9. Release notes must contain **all changes included in that version in both Bulgarian and English** and remain consistent with `CHANGELOG.md`.
10. The matching `dist/*.ocmod.zip` package must be attached to the release.

## Bilingual release notes

Every released version section in `CHANGELOG.md` must contain these top-level language sections:

- `### Български`
- `### English`

Both sections must describe the same complete change set. Use translated subsections as applicable: `Добавено / Added`, `Променено / Changed`, `Поправено / Fixed`, `Сигурност / Security`, `Архитектурни решения / Architecture decisions`.

The release workflow must fail if either language section is missing. GitHub Release notes are generated directly from the matching bilingual `CHANGELOG.md` version section.

## Versioning

The project follows semantic versioning:

- patch for fixes and small compatible corrections;
- minor for backward-compatible features;
- major for incompatible changes.

Tag format is always `v<version>`. Module metadata, package filename, changelog heading and GitHub Release version must refer to the same version.

## Release completeness rule

A PR is not considered fully delivered until PR merge, version bump, bilingual complete `CHANGELOG.md`, versioned `.ocmod.zip`, updated checksum, `v<version>` tag and bilingual GitHub Release are complete.
