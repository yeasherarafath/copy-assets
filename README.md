# CopyAssets Command

## Overview
The `copy-assets` command is a custom Artisan command designed to streamline the process of updating frontend assets in your Laravel application. It performs two key operations:

1. Pulls the latest code from your Git repository
2. Copies frontend assets from a specified source directory to your public assets folder

This command is particularly useful for development and deployment workflows where frontend assets are maintained in a separate repository or directory.

## Usage

```bash
php artisan copy-assets [from] [to]
```

### Parameters

| Parameter | Description | Default Value |
|-----------|-------------|---------------|
| `from` | Source directory containing assets | `mi-trade` |
| `to` | Destination directory for assets | `public/assets` |

### Examples

#### Basic Usage (with defaults)
```bash
php artisan copy-assets
```
This will:
- Pull the latest code from the Git repository
- Copy assets from `mi-trade/assets` to `public/assets/frontend`

#### Custom Source and Destination
```bash
php artisan copy-assets frontend-repo custom/assets
```
This will:
- Pull the latest code from the Git repository
- Copy assets from `frontend-repo/assets` to `custom/assets/frontend`

## How It Works

1. The command first executes `git pull` to ensure your codebase is up to date
2. If the Git pull indicates changes were made, it proceeds with copying assets
3. If the Git pull fails, it displays an error message and stops execution
4. It then copies all files from the source directory to the destination directory
5. Success or failure messages are displayed accordingly

## Error Handling

The command includes robust error handling:
- If the Git pull fails, it displays the specific error message from Git
- If the directory copying fails, it catches the exception and displays the error message
- If assets are already up to date (Git reports "Already up to date"), it notifies you and exits

## Use Cases

- **Development Workflow**: Quickly update frontend assets during development
- **Deployment**: Automate asset updates as part of your deployment process
- **Team Collaboration**: Ensure all team members have the latest frontend assets
- **CI/CD Pipeline**: Include this command in your CI/CD pipeline to automate asset management
