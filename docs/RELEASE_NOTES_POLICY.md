# Release notes policy

Every ProBG Services release must document the complete version changes in both Bulgarian and English.

Required release-note structure:

## Български

- `Добавено`
- `Променено`
- `Поправено`
- `Сигурност`
- `Архитектурни решения`

Use only the subsections that apply, but every actual change in the release must be represented.

## English

- `Added`
- `Changed`
- `Fixed`
- `Security`
- `Architecture decisions`

The English section must describe the same release scope as the Bulgarian section.

The matching version section in `CHANGELOG.md` is the source of truth for GitHub Release notes. A release is invalid if either `### Български` or `### English` is missing.
