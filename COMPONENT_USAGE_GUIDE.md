# 💡 Component Library Usage Guide

Panduan lengkap untuk menggunakan component library baru di AbsenKelas v2.0.0

---

## 🎨 Card Components

### Basic Card

```blade
<div class="card-modern">
    <div class="card-body">
        Your content here
    </div>
</div>
```

### Elevated Card (dengan shadow lebih besar)

```blade
<div class="card-modern elevated">
    <div class="card-body">
        Elevated content
    </div>
</div>
```

### Card dengan Header

```blade
<div class="card-modern">
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 16px;">
        <h5 class="mb-0">Card Title</h5>
    </div>
    <div class="card-body">
        Content here
    </div>
</div>
```

---

## 🔘 Button Components

### Primary Button

```blade
<a href="#" class="btn btn-primary-modern">
    <i class="bi bi-download"></i> Download
</a>
```

### Secondary Button

```blade
<button class="btn btn-secondary-modern">
    <i class="bi bi-edit"></i> Edit
</button>
```

### Danger Button

```blade
<button class="btn btn-danger-modern" onclick="confirm('Delete?') && deleteItem()">
    <i class="bi bi-trash"></i> Delete
</button>
```

### Success Button

```blade
<button class="btn btn-success-modern">
    <i class="bi bi-check"></i> Save
</button>
```

### Button Sizes

#### Small Button

```blade
<button class="btn btn-primary-modern btn-small">Small</button>
```

#### Large Button

```blade
<button class="btn btn-primary-modern btn-large">Large</button>
```

### Button with Icon Only

```blade
<button class="btn btn-primary-modern" title="Refresh">
    <i class="bi bi-arrow-clockwise"></i>
</button>
```

---

## 🏷️ Badge Components

### Basic Badges

```blade
<span class="badge-modern badge-primary">Primary</span>
<span class="badge-modern badge-success">Success</span>
<span class="badge-modern badge-warning">Warning</span>
<span class="badge-modern badge-danger">Danger</span>
<span class="badge-modern badge-info">Info</span>
```

### Status Badges in Table

```blade
@if($item->status == 'Hadir')
    <span class="badge-modern badge-success">Hadir</span>
@elseif($item->status == 'Sakit')
    <span class="badge-modern badge-warning">Sakit</span>
@elseif($item->status == 'Izin')
    <span class="badge-modern badge-info">Izin</span>
@else
    <span class="badge-modern badge-danger">Alpa</span>
@endif
```

---

## ⚠️ Alert Components

### Success Alert

```blade
<div class="alert-modern alert-success">
    <i class="bi bi-check-circle"></i>
    <div><strong>Success!</strong> Operation completed successfully.</div>
</div>
```

### Error Alert

```blade
<div class="alert-modern alert-danger">
    <i class="bi bi-exclamation-circle"></i>
    <div><strong>Error!</strong> An error occurred.</div>
</div>
```

### Info Alert

```blade
<div class="alert-modern alert-primary">
    <i class="bi bi-info-circle"></i>
    <div><strong>Info:</strong> Important information.</div>
</div>
```

### Warning Alert

```blade
<div class="alert-modern alert-warning">
    <i class="bi bi-exclamation-triangle"></i>
    <div><strong>Warning!</strong> Please be careful.</div>
</div>
```

### With Dismissible Button

```blade
<div class="alert-modern alert-success">
    <i class="bi bi-check-circle"></i>
    <div>
        <strong>Success!</strong> Your changes have been saved.
    </div>
    <button class="btn btn-sm" onclick="this.parentElement.style.display='none';">
        <i class="bi bi-x"></i>
    </button>
</div>
```

---

## 📝 Form Components

### Input Modern

```blade
<div class="form-group">
    <label class="form-label">Name:</label>
    <input type="text" class="input-modern" placeholder="Enter name" name="name">
</div>
```

### Select Modern

```blade
<div class="form-group">
    <label class="form-label">Choose Kelas:</label>
    <select class="select-modern" name="kelas_id">
        <option value="">-- Select Kelas --</option>
        @foreach($kelas as $item)
            <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
        @endforeach
    </select>
</div>
```

### Date Input

```blade
<div class="form-group">
    <label class="form-label">Tanggal:</label>
    <input type="date" class="input-modern" name="tanggal">
</div>
```

### Form Group

```blade
<div class="form-group">
    <label class="form-label">Email:</label>
    <input type="email" class="input-modern" placeholder="email@example.com" name="email">
    <small style="color: #999;">Enter your email address</small>
</div>
```

### Disabled Input

```blade
<input type="text" class="input-modern" value="Read Only" disabled>
```

---

## 📊 Table Components

### Basic Table

```blade
<div class="table-responsive">
    <table class="table-modern">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <span class="badge-modern badge-success">Active</span>
                </td>
                <td>
                    <a href="#" class="btn btn-primary-modern btn-small">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
```

### Table with Actions

```blade
<table class="table-modern">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 40%;">Name</th>
            <th style="width: 30%;">Status</th>
            <th style="width: 25%;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->status }}</td>
            <td>
                <a href="{{ route('edit', $row->id) }}" class="btn btn-primary-modern btn-small">
                    <i class="bi bi-pencil"></i>
                </a>
                <button onclick="deleteRow({{ $row->id }})" class="btn btn-danger-modern btn-small">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
```

---

## 🎯 Grid Layouts

### Auto-fit Grid

```blade
<div class="grid-auto">
    <div class="card-modern">Item 1</div>
    <div class="card-modern">Item 2</div>
    <div class="card-modern">Item 3</div>
    <div class="card-modern">Item 4</div>
</div>
```

_Automatically adjusts columns based on available space_

### 2-Column Grid

```blade
<div class="grid-2">
    <div class="card-modern">
        <div class="card-body">Left Content</div>
    </div>
    <div class="card-modern">
        <div class="card-body">Right Content</div>
    </div>
</div>
```

### 3-Column Grid

```blade
<div class="grid-3">
    <div class="card-modern">Item 1</div>
    <div class="card-modern">Item 2</div>
    <div class="card-modern">Item 3</div>
</div>
```

### 4-Column Grid

```blade
<div class="grid-4">
    <div class="card-modern">Item 1</div>
    <div class="card-modern">Item 2</div>
    <div class="card-modern">Item 3</div>
    <div class="card-modern">Item 4</div>
</div>
```

---

## ✨ Animation Classes

### Fade In

```blade
<div class="fade-in">
    This element will fade in
</div>
```

### Fade In Up

```blade
<div class="fade-in-up">
    This element will fade and slide up
</div>
```

### Slide In Left

```blade
<div class="slide-in-left">
    This element slides from left
</div>
```

### Slide In Right

```blade
<div class="slide-in-right">
    This element slides from right
</div>
```

### Pulse Animation

```blade
<div class="pulse">
    <span class="badge-modern badge-danger">Loading...</span>
</div>
```

### Staggered Animations

```blade
@foreach($items as $index => $item)
<div class="card-modern fade-in-up" style="animation-delay: {{ $index * 0.1 }}s">
    {{ $item->name }}
</div>
@endforeach
```

---

## 🎨 Real-world Examples

### Stat Card (Dashboard)

```blade
<div class="card-modern" style="border-left: 4px solid #667eea;">
    <div class="card-body">
        <h6 style="color: #667eea; font-weight: 600; margin-bottom: 12px;">
            <i class="bi bi-people-fill"></i> Total Siswa
        </h6>
        <div style="font-size: 36px; font-weight: 800; margin: 8px 0;">
            {{ $totalSiswa }}
        </div>
        <small style="opacity: 0.7;">Siswa terdaftar dalam sistem</small>
    </div>
</div>
```

### Filter Card

```blade
<div class="card-modern">
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 16px;">
        <h5 class="mb-0"><i class="bi bi-funnel"></i> Filter</h5>
    </div>
    <div class="card-body">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
            <div>
                <label class="form-label">Kelas</label>
                <select class="select-modern">
                    <option>-- Pilih Kelas --</option>
                </select>
            </div>
            <div>
                <label class="form-label">Status</label>
                <select class="select-modern">
                    <option>-- Pilih Status --</option>
                    <option>Hadir</option>
                    <option>Sakit</option>
                    <option>Izin</option>
                    <option>Alpa</option>
                </select>
            </div>
        </div>
        <div style="margin-top: 16px;">
            <button class="btn btn-primary-modern" style="width: 100%;">
                <i class="bi bi-search"></i> Filter
            </button>
        </div>
    </div>
</div>
```

### Data List Card

```blade
<div class="card-modern">
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 16px;">
        <h5 class="mb-0">Data Absensi</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensi as $item)
                    <tr>
                        <td>{{ $item->siswa->nama_lengkap }}</td>
                        <td><span class="badge-modern badge-success">{{ $item->status }}</span></td>
                        <td>{{ $item->tanggal_absen->format('d-m-Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align: center; padding: 20px;">
                            No data available
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
```

### Action Buttons Group

```blade
<div style="display: flex; gap: 8px; margin-top: 16px;">
    <a href="{{ route('download') }}" class="btn btn-primary-modern">
        <i class="bi bi-download"></i> Download
    </a>
    <a href="{{ route('edit') }}" class="btn btn-secondary-modern">
        <i class="bi bi-pencil"></i> Edit
    </a>
    <button onclick="confirm('Delete?') && deleteItem()" class="btn btn-danger-modern">
        <i class="bi bi-trash"></i> Delete
    </button>
</div>
```

---

## 🔗 CSS Variables Reference

```css
/* Colors */
var(--primary)           /* #667eea */
var(--primary-dark)      /* #764ba2 */
var(--primary-light)     /* #8b9df0 */
var(--secondary)         /* #f093fb */
var(--success)           /* #13c296 */
var(--warning)           /* #ffa94d */
var(--danger)            /* #ff6b6b */
var(--info)              /* #00f2fe */
var(--muted)             /* #96a4b1 */
var(--light)             /* #f8f9fa */

/* Shadows */
var(--shadow-sm)         /* 0 4px 15px rgba(0,0,0,0.08) */
var(--shadow-md)         /* 0 12px 30px rgba(0,0,0,0.12) */
var(--shadow-lg)         /* 0 20px 60px rgba(0,0,0,0.3) */

/* Spacing */
var(--transition)        /* all 0.3s ease */

/* Border Radius */
var(--radius-sm)         /* 6px */
var(--radius-md)         /* 10px */
var(--radius-lg)         /* 14px */
```

---

## ⚡ Quick Copy-Paste Templates

### Card with Badge

```blade
<div class="card-modern">
    <div class="card-body">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h6>Title</h6>
            <span class="badge-modern badge-success">Active</span>
        </div>
        Content here
    </div>
</div>
```

### Form with Buttons

```blade
<div class="card-modern">
    <div class="card-body">
        <form>
            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" class="input-modern" name="name" required>
            </div>
            <div style="display: flex; gap: 8px; margin-top: 16px;">
                <button type="submit" class="btn btn-primary-modern">Save</button>
                <a href="javascript:history.back()" class="btn btn-secondary-modern">Cancel</a>
            </div>
        </form>
    </div>
</div>
```

### List with Actions

```blade
<div class="card-modern">
    <div class="card-body">
        <ul style="list-style: none; padding: 0; margin: 0;">
            @foreach($items as $item)
            <li style="padding: 12px 0; border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center;">
                <span>{{ $item->name }}</span>
                <div style="display: flex; gap: 8px;">
                    <a href="#" class="btn btn-primary-modern btn-small">Edit</a>
                    <button class="btn btn-danger-modern btn-small">Delete</button>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
```

---

## 📖 More Information

Untuk informasi lebih detail, lihat:

-   `UPGRADE_DOCUMENTATION.md` - Dokumentasi teknis lengkap
-   `resources/css/components.css` - Source code components
-   `UPGRADE_README.md` - Overview dan setup guide

---

**Last Updated**: December 2, 2025  
**Component Version**: 1.0.0
