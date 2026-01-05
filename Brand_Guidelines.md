# Code Rebuilt CRM - Brand Guidelines

These guidelines describe the visual elements that represent the Code Rebuilt CRM identity.

## 🎨 Color Palette

Our color palette consists of two primary blue shades, complemented by standard black and white for high contrast and readability.

| Color Name | Hex Code | Preview | Usage |
| :--- | :--- | :--- | :--- |
| **Primary Light Blue** | `#46ACD7` | ![#46ACD7](https://placehold.co/15x15/46ACD7/46ACD7.png) | Highlights, buttons, icons, accents |
| **Primary Dark Blue** | `#2D6FAA` | ![#2D6FAA](https://placehold.co/15x15/2D6FAA/2D6FAA.png) | Headings, active states, darker backgrounds |
| **Black** | `#000000` | ![#000000](https://placehold.co/15x15/000000/000000.png) | Main text, strong emphasis |
| **White** | `#FFFFFF` | ![#FFFFFF](https://placehold.co/15x15/FFFFFF/FFFFFF.png) | Backgrounds, text on dark colors |

### CSS Variables Example
```css
:root {
  --color-primary-light: #46ACD7;
  --color-primary-dark: #2D6FAA;
  --color-black: #000000;
  --color-white: #FFFFFF;
}
```

## 🔤 Typography

We use **Montserrat** as our primary typeface. It is a modern geometric sans-serif font that conveys trust and professionalism.

### Primary Font: **Montserrat**

*   **Weights:**
    *   **Regular (400):** Body text, paragraphs.
    *   **Semi-Bold (600):** Subheadings, navigation links, buttons.
    *   **Bold (700):** Main headings, CTAs.

### Usage in CSS
To use Montserrat, import it from Google Fonts:

```html
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
```

```css
body {
  font-family: 'Montserrat', sans-serif;
}
```
