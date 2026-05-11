# 🎨 Nehru College - Modern Dashboard Design System

## Color Palette

### Primary Colors
```
Primary Dark    #091a33  - Main text, dark elements
Primary Mid     #1d3f7a  - Navigation, headers
Primary Light   #4f8bfd  - Interactive elements
Primary Soft    #dbe8ff  - Light backgrounds
```

### Accent Colors
```
Cyan            #22c3e3  - Highlights, badges
Cyan Soft       #d2f7ff  - Light backgrounds
```

### Neutral Colors
```
Text Dark       #0f172a  - Main text
Text Muted      #52647a  - Secondary text
Text Light      #7d8fa3  - Tertiary text
Background      #ffffff  - Card backgrounds
```

## Layout Components

### Sidebar
- **Width**: 280px fixed position
- **Background**: Linear gradient (white to light blue)
- **Active State**: Gradient background + left border
- **Hover State**: Light blue background

### Topbar
- **Height**: 60px
- **Background**: Soft white with border
- **User Profile**: Avatar + name + role
- **Actions**: Logout button with hover effect

### Main Content
- **Background**: Gradient (light blue)
- **Padding**: 32px
- **Max Content Width**: Full responsive

### Stat Cards
- **Height**: Auto
- **Top Border**: Gradient (4px)
- **Hover**: Lift up 6px with enhanced shadow
- **Icon**: 56x56px with gradient background

## Typography

### Font Family
```
Font: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif
```

### Font Weights
```
Regular      400
Medium       500
Semibold     600
Bold         700
ExtraBold    800
Black        900
```

### Font Sizes
```
Large Title      2rem    (32px)
Title           1.5rem   (24px)
Heading         1.1rem   (18px)
Body            0.95rem  (15px)
Small           0.85rem  (13.6px)
Tiny            0.75rem  (12px)
```

## Spacing System

### Padding
```
Extra Small     0.5rem   (8px)
Small          1rem     (16px)
Medium         1.5rem   (24px)
Large          2rem     (32px)
Extra Large    3rem     (48px)
```

### Gap
```
Small          0.5rem   (8px)
Medium         1rem     (16px)
Large          1.5rem   (24px)
Extra Large    2rem     (32px)
```

## Border Radius

```
Small       14px
Medium      18px
Large       24px
```

## Shadows

```
Soft        0 24px 60px rgba(9, 26, 51, 0.08)
Strong      0 30px 80px rgba(9, 26, 51, 0.14)
Hover       0 40px 100px rgba(9, 26, 51, 0.18)
```

## Components

### Buttons
```
Primary     Gradient (Primary Mid → Cyan)
Secondary   White with border
Hover       Lift 2px with enhanced shadow
```

### Form Controls
```
Border Color    rgba(79, 139, 253, 0.18)
Focus Border    var(--primary-light)
Focus Shadow    0 0 0 3px rgba(79, 139, 253, 0.1)
```

### Badges
```
Success     Background: rgba(34, 195, 227, 0.1)
            Color: #22c3e3
Warning     Background: rgba(245, 158, 11, 0.1)
            Color: #f59e0b
Danger      Background: rgba(239, 68, 68, 0.1)
            Color: #ef4444
```

### Tables
```
Header Background   Gradient (Primary soft)
Row Hover          Light blue background
Border             rgba(79, 139, 253, 0.12)
```

## Animations

### Fade In
```css
animation: fadeIn 0.5s ease;
```

### Slide In Left
```css
animation: slideInLeft 0.5s ease;
```

### Hover Lift
```css
transform: translateY(-6px);
```

## Responsive Breakpoints

### Desktop
- `min-width: 1025px`
- Full sidebar, normal padding

### Tablet
- `1024px - 769px`
- Sidebar 250px, optimized spacing

### Mobile
- `768px - 481px`
- Sidebar overlay, reduced padding

### Small Mobile
- `< 480px`
- Compact layout, minimal padding

## CSS Variables Usage

```css
/* Colors */
color: var(--text-dark);
background: var(--bg-page);

/* Spacing */
padding: 2rem;
gap: 1.5rem;

/* Shadows */
box-shadow: var(--shadow-soft);

/* Radii */
border-radius: var(--radius-md);

/* Gradients */
background: var(--gradient-primary);
```

## Implementation Tips

1. **Always use CSS variables** for colors and spacing
2. **Apply shadows on hover** for interactive elements
3. **Use gradients** for primary action buttons
4. **Maintain consistent spacing** using the spacing system
5. **Test on mobile** at 768px breakpoint
6. **Use backdrop-filter** for glass effects
7. **Add transitions** for smooth interactions

## Quick References

### Standard Card
```html
<div class="card" style="border: 1px solid var(--border-card);">
    <div class="card-header">Header</div>
    <div class="card-body">Content</div>
</div>
```

### Primary Button
```html
<button class="btn btn-primary-modern">Action</button>
```

### Stat Card
```html
<div class="card stat-card stat-card-users">
    <div class="card-body">
        <p class="stat-label">Label</p>
        <h2 class="stat-number">123</h2>
        <div class="stat-icon"><i class="bi bi-icon"></i></div>
    </div>
</div>
```

### Badge
```html
<span class="badge-status badge-active">Active</span>
```

## Files to Modify

When adding new pages:
1. Import dashboard.css
2. Use existing color variables
3. Follow responsive breakpoints
4. Match typography scales
5. Use consistent shadows and borders

---

**Version**: 1.0  
**Last Updated**: April 28, 2026  
**Design System**: Modern Professional Light Blue
