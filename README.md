# Zenmatters

Website for Zenmatters, a home-based massage practice in Baarn (NL), built on [Kirby CMS](https://getkirby.com) so the owner can edit copy, images, pricing, and promotions herself via the Panel — no developer needed for day-to-day updates.

See [CLAUDE.md](CLAUDE.md) for full project conventions, blueprint rules, staging deployment, and common tasks.

## Stack

- Kirby CMS 5 (flat-file, PHP 8.2+)
- Plain CSS with custom properties — no build step
- Self-hosted fonts (TT Fors Trial)

## Local development

```bash
composer install
/opt/homebrew/bin/php -S localhost:8765 kirby/router.php
```

Visit `http://localhost:8765/panel` for the first-time admin setup.

## Deployment

Code and content are pushed to a managed PHP host via `rsync` — see the **Staging server** and **Commands** sections in [CLAUDE.md](CLAUDE.md) for exact paths and commands. There is no CI/CD pipeline; deploys are manual.

## License

Kirby requires a paid license for production use — see [getkirby.com/buy](https://getkirby.com/buy).
