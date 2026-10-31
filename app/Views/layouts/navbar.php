<?php
$page = service('uri')->getSegment(1) ?: 'barang';

$menus = [
    [
        'url' => 'barang',
        'label' => 'Dashboard & Barang',
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><path d="m3.27 6.96 8.73 5.05 8.73-5.05M12 22V12"/></svg>'
    ],
    [
        'url' => 'konsumen',
        'label' => 'Master Konsumen',
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>'
    ],
    [
        'url' => 'kasir',
        'label' => 'Master Kasir',
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>'
    ],
    [
        'url' => 'transaksi',
        'label' => 'Transaksi Penjualan',
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><path d="M1 10h22"/></svg>'
    ]
];
?>

<style>
    body {
        padding-left: 250px !important;
        background-color: #f8fafc;
    }

    .container {
        max-width: 100% !important;
        width: 100% !important;
        padding: 28px 32px !important;
        margin: 0 !important;
        box-sizing: border-box;
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px 16px !important;
        }
    }

    .sidebar-left {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100vh;
        background: #fff;
        border-right: 1px solid #e4e4e7;
        display: flex;
        flex-direction: column;
        padding: 24px 16px;
        z-index: 1000;
        box-sizing: border-box;
    }

    .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        padding: 0 8px 24px;
        border-bottom: 1px solid #f4f4f5;
        margin-bottom: 20px;
    }

    .brand-icon {
        background: #18181b;
        color: white;
        font-weight: 800;
        font-size: .85rem;
        padding: 8px 10px;
        border-radius: 8px;
    }

    .brand-text {
        display: flex;
        flex-direction: column;
    }

    .brand-title {
        font-weight: 700;
        font-size: 1rem;
        color: #18181b;
    }

    .brand-subtitle {
        font-size: .72rem;
        color: #71717a;
    }

    .sidebar-menu-label {
        font-size: .68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #a1a1aa;
        padding: 0 12px;
        margin-bottom: 8px;
    }

    .sidebar-links {
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex: 1;
    }

    .sidebar-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 14px;
        border-radius: 8px;
        text-decoration: none;
        font-size: .875rem;
        font-weight: 600;
        color: #52525b;
    }

    .sidebar-item:hover {
        background: #f4f4f5;
        color: #18181b;
    }

    .sidebar-item.active {
        background: #18181b;
        color: white;
    }

    .sidebar-item svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    .sidebar-footer {
        padding: 16px 8px 0;
        border-top: 1px solid #f4f4f5;
        font-size: .75rem;
        color: #71717a;
    }

    @media(max-width:768px) {
        body {
            padding-left: 0 !important;
        }

        .sidebar-left {
            position: relative;
            width: 100%;
            height: auto;
        }
    }
</style>

<aside class="sidebar-left">
    <a href="<?= base_url('barang') ?>" class="sidebar-brand">
        <div class="brand-icon">POS</div>
        <div class="brand-text">
            <span class="brand-title">Sistem Kasir</span>
            <span class="brand-subtitle">Management System</span>
        </div>
    </a>

    <div class="sidebar-menu-label">Menu Utama</div>

    <div class="sidebar-links">
        <?php foreach ($menus as $menu): ?>
            <a href="<?= base_url($menu['url']) ?>"
                class="sidebar-item <?= $page === $menu['url'] ? 'active' : '' ?>">
                <?= $menu['icon'] ?>
                <span><?= esc($menu['label']) ?></span>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="sidebar-footer">
        <div style="font-weight:600;color:#18181b">POS System v1.0</div>
        <div>Made with ☕</div>
    </div>
</aside>