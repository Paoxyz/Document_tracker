<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DocuTrack — All Documents</title>
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;1,400&family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet" />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; }

    :root {
      --cream: #FAF9F7;
      --white: #FFFFFF;
      --ink: #1C1C1A;
      --ink2: #3D3D3A;
      --muted: #8C8C88;
      --border: #E8E6E1;
      --border2: #D4D1CB;
      --sidebar-w: 232px;
      --topbar-h: 60px;
      --accent: #2D6A4F;
      --accent-hover: #235C42;
      --accent-light: #52B788;
      --accent-bg: #EEF7F2;
      --accent-border: #C3E6D4;
      --warn: #B45309;
      --warn-bg: #FEF3C7;
      --warn-border: #FDE68A;
      --danger: #B91C1C;
      --danger-bg: #FEE2E2;
      --danger-border: #FECACA;
      --info: #1E40AF;
      --info-bg: #EFF6FF;
      --info-border: #BFDBFE;
      --gray-bg: #F3F4F6;
      --gray-border: #E5E7EB;
      --gray-text: #6B7280;
    }

    body {
      background: var(--cream);
      color: var(--ink);
      font-family: 'Instrument Sans', sans-serif;
      font-size: 14px;
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
      display: flex;
    }

    h1, h2, h3, h4 { font-family: 'Lora', serif; font-weight: 600; color: var(--ink); }

    /* ── SIDEBAR ── */
    .sidebar {
      width: var(--sidebar-w); min-height: 100vh;
      background: var(--white); border-right: 1px solid var(--border);
      display: flex; flex-direction: column;
      position: fixed; top: 0; left: 0; z-index: 50;
    }
    .sidebar-logo {
      padding: 0 20px; height: var(--topbar-h);
      display: flex; align-items: center; gap: 10px;
      border-bottom: 1px solid var(--border); text-decoration: none;
    }
    .logo-icon {
      width: 32px; height: 32px; background: var(--accent);
      border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .logo-name { font-family: 'Lora', serif; font-size: 16px; font-weight: 600; color: var(--ink); letter-spacing: -0.02em; }
    .sidebar-section { padding: 20px 12px 8px; }
    .sidebar-label { font-size: 10px; font-weight: 600; color: var(--muted); letter-spacing: 0.08em; text-transform: uppercase; padding: 0 8px; margin-bottom: 4px; }
    .nav-item {
      display: flex; align-items: center; gap: 10px;
      padding: 8px 10px; border-radius: 8px;
      font-size: 13px; font-weight: 500; color: var(--ink2);
      cursor: pointer; text-decoration: none;
      transition: background 0.12s, color 0.12s; margin-bottom: 1px;
    }
    .nav-item:hover { background: var(--cream); color: var(--ink); }
    .nav-item.active { background: var(--accent-bg); color: var(--accent); font-weight: 600; }
    .nav-item svg { flex-shrink: 0; opacity: 0.7; }
    .nav-item.active svg { opacity: 1; }
    .nav-badge {
      margin-left: auto; font-size: 10px; font-weight: 700;
      background: var(--warn-bg); color: var(--warn);
      border: 1px solid var(--warn-border); padding: 1px 7px; border-radius: 10px;
    }
    .nav-badge.green { background: var(--accent-bg); color: var(--accent); border-color: var(--accent-border); }
    .sidebar-bottom { margin-top: auto; padding: 16px 12px; border-top: 1px solid var(--border); }
    .user-row {
      display: flex; align-items: center; gap: 10px;
      padding: 8px 10px; border-radius: 8px; cursor: pointer; transition: background 0.12s;
    }
    .user-row:hover { background: var(--cream); }
    .avatar {
      width: 32px; height: 32px; border-radius: 50%;
      background: var(--accent-bg); border: 1.5px solid var(--accent-border);
      display: flex; align-items: center; justify-content: center;
      font-size: 12px; font-weight: 700; color: var(--accent); flex-shrink: 0;
    }
    .user-name { font-size: 13px; font-weight: 600; color: var(--ink); }
    .user-role { font-size: 11px; color: var(--muted); }

    /* ── MAIN ── */
    .main { margin-left: var(--sidebar-w); flex: 1; min-height: 100vh; display: flex; flex-direction: column; }

    /* TOPBAR */
    .topbar {
      height: var(--topbar-h); background: var(--white); border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 28px; position: sticky; top: 0; z-index: 40;
    }
    .topbar-title { font-family: 'Lora', serif; font-size: 16px; font-weight: 600; color: var(--ink); }
    .breadcrumb { font-size: 12px; color: var(--muted); }
    .breadcrumb span { color: var(--ink2); }
    .topbar-right { display: flex; align-items: center; gap: 10px; }
    .topbar-btn {
      background: var(--white); border: 1px solid var(--border2); color: var(--ink2);
      padding: 6px 14px; border-radius: 7px; font-size: 13px; font-weight: 500; cursor: pointer;
      font-family: 'Instrument Sans', sans-serif; display: flex; align-items: center; gap: 6px;
      transition: background 0.12s;
    }
    .topbar-btn:hover { background: var(--cream); }
    .topbar-btn.primary { background: var(--accent); color: #fff; border-color: var(--accent); }
    .topbar-btn.primary:hover { background: var(--accent-hover); }
    .notif-btn {
      width: 34px; height: 34px; border-radius: 8px;
      background: var(--white); border: 1px solid var(--border);
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; transition: background 0.12s; position: relative;
    }
    .notif-btn:hover { background: var(--cream); }
    .notif-dot { width: 7px; height: 7px; background: var(--warn); border-radius: 50%; position: absolute; top: 6px; right: 6px; border: 1.5px solid var(--white); }

    /* CONTENT */
    .content { padding: 28px; flex: 1; }

    /* PILLS */
    .pill {
      display: inline-flex; align-items: center; gap: 4px;
      font-size: 11px; font-weight: 600; padding: 3px 9px;
      border-radius: 20px; white-space: nowrap; letter-spacing: 0.01em;
    }
    .pill-green  { background: var(--accent-bg);  color: var(--accent);  border: 1px solid var(--accent-border); }
    .pill-amber  { background: var(--warn-bg);     color: var(--warn);    border: 1px solid var(--warn-border); }
    .pill-blue   { background: var(--info-bg);     color: var(--info);    border: 1px solid var(--info-border); }
    .pill-gray   { background: var(--gray-bg);     color: var(--gray-text); border: 1px solid var(--gray-border); }
    .pill-red    { background: var(--danger-bg);   color: var(--danger);  border: 1px solid var(--danger-border); }

    /* PAGE HEADER */
    .page-header {
      display: flex; align-items: flex-start; justify-content: space-between;
      margin-bottom: 24px;
    }
    .page-title { font-family: 'Lora', serif; font-size: 22px; font-weight: 600; color: var(--ink); margin-bottom: 3px; }
    .page-sub { font-size: 13px; color: var(--muted); }

    /* FILTER BAR */
    .filter-bar {
      display: flex; align-items: center; gap: 10px;
      margin-bottom: 16px; flex-wrap: wrap;
    }
    .search-wrap {
      position: relative; flex: 1; min-width: 220px; max-width: 320px;
    }
    .search-wrap svg { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); pointer-events: none; }
    .search-input {
      width: 100%; padding: 8px 12px 8px 34px;
      background: var(--white); border: 1px solid var(--border2);
      border-radius: 8px; font-size: 13px; color: var(--ink);
      font-family: 'Instrument Sans', sans-serif;
      transition: border-color 0.12s;
      outline: none;
    }
    .search-input::placeholder { color: var(--muted); }
    .search-input:focus { border-color: var(--accent-light); }
    .filter-select {
      padding: 8px 28px 8px 12px; background: var(--white);
      border: 1px solid var(--border2); border-radius: 8px;
      font-size: 13px; color: var(--ink2); cursor: pointer;
      font-family: 'Instrument Sans', sans-serif; outline: none;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 6L11 1' stroke='%238C8C88' stroke-width='1.5' stroke-linecap='round'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 10px center;
      transition: border-color 0.12s;
    }
    .filter-select:focus { border-color: var(--accent-light); }
    .filter-divider { width: 1px; height: 24px; background: var(--border2); }
    .view-toggle { display: flex; border: 1px solid var(--border2); border-radius: 8px; overflow: hidden; }
    .view-btn {
      padding: 7px 11px; background: var(--white); border: none; cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: background 0.12s; color: var(--muted);
    }
    .view-btn:hover { background: var(--cream); }
    .view-btn.active { background: var(--cream); color: var(--ink); }
    .view-btn + .view-btn { border-left: 1px solid var(--border2); }

    /* STATUS FILTER TABS */
    .status-tabs { display: flex; gap: 2px; margin-bottom: 16px; background: var(--white); border: 1px solid var(--border); border-radius: 10px; padding: 4px; width: fit-content; }
    .status-tab {
      padding: 6px 14px; border-radius: 7px; font-size: 12px; font-weight: 600;
      cursor: pointer; color: var(--muted); transition: background 0.12s, color 0.12s;
      display: flex; align-items: center; gap: 6px; white-space: nowrap;
    }
    .status-tab:hover { color: var(--ink); }
    .status-tab.active { background: var(--accent-bg); color: var(--accent); }
    .tab-count {
      font-size: 10px; font-weight: 700; padding: 1px 6px;
      border-radius: 8px; background: rgba(0,0,0,0.06);
    }
    .status-tab.active .tab-count { background: var(--accent-border); color: var(--accent); }

    /* DOCUMENT TABLE CARD */
    .card { background: var(--white); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; }
    .card-header {
      padding: 14px 18px; border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
    }
    .card-title { font-size: 13px; font-weight: 600; color: var(--ink); }

    .doc-table { width: 100%; border-collapse: collapse; }
    .doc-table th {
      font-size: 10px; font-weight: 600; color: var(--muted);
      text-transform: uppercase; letter-spacing: 0.06em;
      padding: 11px 16px; text-align: left;
      border-bottom: 1px solid var(--border);
      background: var(--cream);
      white-space: nowrap;
    }
    .doc-table th.sortable { cursor: pointer; user-select: none; }
    .doc-table th.sortable:hover { color: var(--ink2); }
    .sort-icon { opacity: 0.4; margin-left: 3px; }
    .sort-icon.active { opacity: 1; color: var(--accent); }
    .doc-table td { padding: 13px 16px; border-bottom: 1px solid var(--border); font-size: 13px; color: var(--ink2); vertical-align: middle; }
    .doc-table tr:last-child td { border-bottom: none; }
    .doc-table tbody tr { transition: background 0.1s; cursor: pointer; }
    .doc-table tbody tr:hover td { background: #F7F6F3; }

    .td-doc { display: flex; align-items: center; gap: 11px; }
    .td-doc-icon { width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .td-doc-name { font-weight: 600; color: var(--ink); font-size: 13px; }
    .td-doc-ref { font-size: 11px; color: var(--muted); margin-top: 1px; }
    .td-small { font-size: 12px; color: var(--muted); }
    .td-name { font-size: 12px; color: var(--ink2); }

    /* CHECKBOX */
    .cb {
      width: 15px; height: 15px; border-radius: 4px;
      border: 1.5px solid var(--border2); background: var(--white);
      cursor: pointer; flex-shrink: 0; transition: border-color 0.12s;
      appearance: none; -webkit-appearance: none;
    }
    .cb:checked { background: var(--accent); border-color: var(--accent); }
    .cb:checked::after { content: ''; display: block; width: 4px; height: 7px; border: 2px solid white; border-top: none; border-left: none; transform: rotate(45deg) translate(2px, 0px); }

    /* ROW ACTIONS */
    .row-actions { display: flex; align-items: center; gap: 4px; opacity: 0; transition: opacity 0.12s; }
    tr:hover .row-actions { opacity: 1; }
    .row-btn {
      padding: 5px 10px; border-radius: 6px; font-size: 11px; font-weight: 600;
      border: 1px solid var(--border2); background: var(--white); color: var(--ink2);
      cursor: pointer; font-family: 'Instrument Sans', sans-serif;
      transition: background 0.1s;
    }
    .row-btn:hover { background: var(--cream); }
    .row-btn.accent { background: var(--accent-bg); color: var(--accent); border-color: var(--accent-border); }
    .row-btn.accent:hover { background: #DCF0E7; }

    /* PAGINATION */
    .pagination {
      display: flex; align-items: center; justify-content: space-between;
      padding: 14px 18px; border-top: 1px solid var(--border);
    }
    .pag-info { font-size: 12px; color: var(--muted); }
    .pag-btns { display: flex; gap: 4px; }
    .pag-btn {
      width: 30px; height: 30px; border-radius: 7px; border: 1px solid var(--border);
      background: var(--white); display: flex; align-items: center; justify-content: center;
      font-size: 12px; font-weight: 600; cursor: pointer; color: var(--ink2);
      transition: background 0.1s; font-family: 'Instrument Sans', sans-serif;
    }
    .pag-btn:hover { background: var(--cream); }
    .pag-btn.active { background: var(--accent); color: #fff; border-color: var(--accent); }
    .pag-btn:disabled { opacity: 0.35; cursor: default; }

    /* EMPTY / LOADING ROW */
    .empty-row td { text-align: center; padding: 48px; color: var(--muted); font-size: 13px; }

    /* BULK ACTION BAR */
    .bulk-bar {
      display: none; align-items: center; gap: 12px;
      padding: 10px 18px; background: var(--accent-bg);
      border-bottom: 1px solid var(--accent-border);
    }
    .bulk-bar.visible { display: flex; }
    .bulk-text { font-size: 13px; font-weight: 600; color: var(--accent); }
    .bulk-btn {
      padding: 5px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;
      border: 1px solid var(--accent-border); background: var(--white); color: var(--ink2);
      cursor: pointer; font-family: 'Instrument Sans', sans-serif; transition: background 0.1s;
    }
    .bulk-btn:hover { background: #DCF0E7; }
    .bulk-btn.danger { border-color: var(--danger-border); color: var(--danger); }
    .bulk-btn.danger:hover { background: var(--danger-bg); }

    /* DOCUMENT DETAIL DRAWER */
    .drawer-overlay {
      position: fixed; inset: 0; background: rgba(0,0,0,0.2);
      z-index: 200; opacity: 0; pointer-events: none;
      transition: opacity 0.2s;
    }
    .drawer-overlay.open { opacity: 1; pointer-events: all; }
    .drawer {
      position: fixed; top: 0; right: 0; bottom: 0; width: 400px;
      background: var(--white); border-left: 1px solid var(--border);
      z-index: 201; transform: translateX(100%);
      transition: transform 0.25s cubic-bezier(0.4,0,0.2,1);
      display: flex; flex-direction: column;
      box-shadow: -8px 0 32px rgba(0,0,0,0.08);
    }
    .drawer.open { transform: translateX(0); }
    .drawer-header {
      padding: 18px 20px; border-bottom: 1px solid var(--border);
      display: flex; align-items: flex-start; justify-content: space-between; flex-shrink: 0;
    }
    .drawer-close {
      width: 28px; height: 28px; border-radius: 7px; border: 1px solid var(--border);
      background: var(--white); display: flex; align-items: center; justify-content: center;
      cursor: pointer; flex-shrink: 0; transition: background 0.12s;
    }
    .drawer-close:hover { background: var(--cream); }
    .drawer-body { padding: 20px; overflow-y: auto; flex: 1; }
    .drawer-footer {
      padding: 16px 20px; border-top: 1px solid var(--border);
      display: flex; gap: 8px; flex-shrink: 0;
    }
    .drawer-title { font-family: 'Lora', serif; font-size: 16px; font-weight: 600; color: var(--ink); margin-bottom: 4px; }
    .drawer-ref { font-size: 12px; color: var(--muted); }
    .detail-section { margin-bottom: 22px; }
    .detail-section-label { font-size: 10px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 10px; }
    .detail-row { display: flex; align-items: flex-start; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--border); }
    .detail-row:last-child { border-bottom: none; }
    .detail-key { font-size: 12px; color: var(--muted); }
    .detail-val { font-size: 12px; font-weight: 600; color: var(--ink2); text-align: right; max-width: 200px; }
    .timeline-item { display: flex; gap: 12px; padding-bottom: 18px; position: relative; }
    .timeline-item::before { content: ''; position: absolute; left: 6px; top: 16px; bottom: 0; width: 1px; background: var(--border); }
    .timeline-item:last-child::before { display: none; }
    .timeline-dot { width: 13px; height: 13px; border-radius: 50%; flex-shrink: 0; margin-top: 2px; border: 2px solid var(--white); box-shadow: 0 0 0 1px var(--border2); }
    .timeline-text { font-size: 12px; color: var(--ink2); line-height: 1.5; }
    .timeline-text strong { color: var(--ink); font-weight: 600; }
    .timeline-time { font-size: 11px; color: var(--muted); margin-top: 2px; }
    .full-btn {
      flex: 1; padding: 9px; border-radius: 8px; font-size: 13px; font-weight: 600;
      border: 1px solid var(--border2); background: var(--white); color: var(--ink2);
      cursor: pointer; font-family: 'Instrument Sans', sans-serif; transition: background 0.12s;
    }
    .full-btn:hover { background: var(--cream); }
    .full-btn.primary { background: var(--accent); color: #fff; border-color: var(--accent); }
    .full-btn.primary:hover { background: var(--accent-hover); }

    /* SCROLLBAR */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: var(--cream); }
    ::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 3px; }

    /* ANIMATIONS */
    @keyframes fadeUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .content > * { animation: fadeUp 0.35s ease both; }
    .content > *:nth-child(1) { animation-delay: 0.04s; }
    .content > *:nth-child(2) { animation-delay: 0.08s; }
    .content > *:nth-child(3) { animation-delay: 0.12s; }
  </style>
</head>
<body>

  <aside class="sidebar">
    <a class="sidebar-logo" href="dashboard.php">
      <div class="logo-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
          <polyline points="14 2 14 8 20 8"/>
        </svg>
      </div>
      <span class="logo-name">DocuTrack</span>
    </a>

    <div class="sidebar-section">
      <div class="sidebar-label">Main</div>
      <a class="nav-item" href="dashboard.php">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        Overview
      </a>
      <a class="nav-item active" href="documents.php">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        All Documents
        <span class="nav-badge green">12</span>
      </a>
      <a class="nav-item" href="#">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        Pending Review
        <span class="nav-badge">5</span>
      </a>
      <a class="nav-item" href="#">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        Routing Queue
      </a>
      <a class="nav-item" href="#">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        Approved
      </a>
      <a class="nav-item" href="#">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        Archive
      </a>
    </div>

    <div class="sidebar-section">
      <div class="sidebar-label">Manage</div>
      <a class="nav-item" href="#">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        Departments
      </a>
      <a class="nav-item" href="#">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
        Reports
      </a>
      <a class="nav-item" href="#">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2M12 20v2M20 12h2M2 12h2M17.66 17.66l-1.41-1.41M6.34 17.66l1.41-1.41"/></svg>
        Settings
      </a>
    </div>

    <div class="sidebar-bottom">
      <div class="user-row">
        <div class="avatar">JR</div>
        <div>
          <div class="user-name">J. Reyes</div>
          <div class="user-role">Administrator</div>
        </div>
        <svg style="margin-left:auto;opacity:0.4;" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
      </div>
    </div>
  </aside>

  <div class="main">
    <header class="topbar">
      <div>
        <div class="topbar-title">All Documents</div>
        <div class="breadcrumb">DocuTrack / <span>All Documents</span></div>
      </div>
      <div class="topbar-right">
        <div class="notif-btn">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6B6B67" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3z"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
          <div class="notif-dot"></div>
        </div>
        <button class="topbar-btn">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          Export
        </button>
        <button class="topbar-btn primary" onclick="openDrawer('new')">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Upload Document
        </button>
      </div>
    </header>

    <div class="content">

      <div class="page-header">
        <div>
          <div class="page-title">All Documents</div>
          <div class="page-sub">Browse, search, and manage every document in the system.</div>
        </div>
      </div>

      <div class="filter-bar">
        <div class="search-wrap">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#8C8C88" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input class="search-input" type="text" placeholder="Search by name, ID, or department…" id="searchInput" oninput="filterDocs()" />
        </div>
        <select class="filter-select" id="typeFilter" onchange="filterDocs()">
          <option value="">All Types</option>
          <option value="Finance">Finance</option>
          <option value="Legal">Legal</option>
          <option value="HR">HR</option>
          <option value="Admin">Admin</option>
          <option value="Archive">Archive</option>
        </select>
        <select class="filter-select" id="deptFilter" onchange="filterDocs()">
          <option value="">All Departments</option>
          <option value="Finance Dept.">Finance Dept.</option>
          <option value="Legal Team">Legal Team</option>
          <option value="HR Admin">HR Admin</option>
          <option value="Director's Office">Director's Office</option>
          <option value="Storage">Storage</option>
        </select>
        <div class="filter-divider"></div>
        <div class="view-toggle">
          <button class="view-btn active" title="Table view">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
          </button>
          <button class="view-btn" title="Grid view">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
          </button>
        </div>
      </div>

      <div class="status-tabs" id="statusTabs">
        <div class="status-tab active" onclick="setStatus(this,'')">All <span class="tab-count" id="count-all">12</span></div>
        <div class="status-tab" onclick="setStatus(this,'Pending')">Pending <span class="tab-count" id="count-pending">3</span></div>
        <div class="status-tab" onclick="setStatus(this,'In Review')">In Review <span class="tab-count" id="count-review">2</span></div>
        <div class="status-tab" onclick="setStatus(this,'Approved')">Approved <span class="tab-count" id="count-approved">4</span></div>
        <div class="status-tab" onclick="setStatus(this,'Returned')">Returned <span class="tab-count" id="count-returned">1</span></div>
        <div class="status-tab" onclick="setStatus(this,'Archived')">Archived <span class="tab-count" id="count-archived">2</span></div>
      </div>

      <div class="card">
        <div class="bulk-bar" id="bulkBar">
          <span class="bulk-text" id="bulkText">0 selected</span>
          <button class="bulk-btn">Reassign</button>
          <button class="bulk-btn">Export</button>
          <button class="bulk-btn danger">Delete</button>
          <button class="bulk-btn" style="margin-left:auto;" onclick="clearSelection()">Clear</button>
        </div>

        <table class="doc-table" id="docTable">
          <thead>
            <tr>
              <th style="width:36px;padding-left:18px;"><input type="checkbox" class="cb" id="selectAll" onchange="toggleAll(this)" /></th>
              <th class="sortable" onclick="sortBy('name')">Document <span class="sort-icon active" id="sort-name">↑</span></th>
              <th class="sortable" onclick="sortBy('type')">Type <span class="sort-icon" id="sort-type">↕</span></th>
              <th class="sortable" onclick="sortBy('dept')">Assigned To <span class="sort-icon" id="sort-dept">↕</span></th>
              <th class="sortable" onclick="sortBy('date')">Date <span class="sort-icon" id="sort-date">↕</span></th>
              <th class="sortable" onclick="sortBy('status')">Status <span class="sort-icon" id="sort-status">↕</span></th>
              <th style="text-align:right;padding-right:18px;">Actions</th>
            </tr>
          </thead>
          <tbody id="docTbody"></tbody>
        </table>

        <div class="pagination">
          <span class="pag-info" id="pagInfo">Showing 1–10 of 12</span>
          <div class="pag-btns">
            <button class="pag-btn" id="prevBtn" onclick="changePage(-1)" disabled>‹</button>
            <button class="pag-btn active" id="page1" onclick="goPage(1)">1</button>
            <button class="pag-btn" id="page2" onclick="goPage(2)">2</button>
            <button class="pag-btn" id="nextBtn" onclick="changePage(1)">›</button>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>
  <div class="drawer" id="drawer">
    <div class="drawer-header">
      <div>
        <div class="drawer-title" id="drawerTitle">Document Name</div>
        <div class="drawer-ref" id="drawerRef">REF-000 · Finance</div>
      </div>
      <button class="drawer-close" onclick="closeDrawer()">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6B6B67" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>
    <div class="drawer-body">
      <div class="detail-section">
        <div class="detail-section-label">Details</div>
        <div class="detail-row"><span class="detail-key">Reference ID</span><span class="detail-val" id="dRef">—</span></div>
        <div class="detail-row"><span class="detail-key">Document Type</span><span class="detail-val" id="dType">—</span></div>
        <div class="detail-row"><span class="detail-key">Assigned To</span><span class="detail-val" id="dDept">—</span></div>
        <div class="detail-row"><span class="detail-key">Submitted</span><span class="detail-val" id="dDate">—</span></div>
        <div class="detail-row"><span class="detail-key">Submitted By</span><span class="detail-val" id="dBy">—</span></div>
        <div class="detail-row"><span class="detail-key">Status</span><span class="detail-val" id="dStatus">—</span></div>
      </div>
      <div class="detail-section">
        <div class="detail-section-label">Routing History</div>
        <div id="drawerTimeline"></div>
      </div>
    </div>
    <div class="drawer-footer">
      <button class="full-btn" onclick="closeDrawer()">Close</button>
      <button class="full-btn primary">Open Full View</button>
    </div>
  </div>

  <script>
    // ── DATA ──
    const ALL_DOCS = [
      { id:1, name:'Procurement Request',    ref:'REQ-001', type:'Finance', dept:'Finance Dept.',    date:'Today, 9:14 AM',   by:'M. Santos',   status:'Pending',   icon:'warn',
        timeline:[{c:'#FCD34D',t:'<strong>Submitted</strong> by M. Santos',time:'Today, 9:14 AM'},{c:'#93C5FD',t:'<strong>Routed</strong> to Finance Dept.',time:'Today, 9:15 AM'}] },
      { id:2, name:'Compliance Memo',         ref:'MEMO-044', type:'Legal',   dept:'Legal Team',       date:'Today, 8:50 AM',   by:'A. Cruz',     status:'In Review', icon:'blue',
        timeline:[{c:'#93C5FD',t:'<strong>Submitted</strong> by A. Cruz',time:'Today, 8:50 AM'},{c:'#93C5FD',t:'<strong>Routed</strong> to Legal Team',time:'Today, 8:51 AM'},{c:'#FCD34D',t:'<strong>Under review</strong> by Legal Team',time:'Today, 9:00 AM'}] },
      { id:3, name:'Vendor Contract',         ref:'CONT-018', type:'Legal',   dept:'Legal Team',       date:'Yesterday',        by:'B. Lim',      status:'Approved',  icon:'green',
        timeline:[{c:'#86EFAC',t:'<strong>Submitted</strong> by B. Lim',time:'2 days ago'},{c:'#93C5FD',t:'<strong>Reviewed</strong> by Legal Team',time:'Yesterday, 2pm'},{c:'#86EFAC',t:'<strong>Approved</strong> by J. Reyes',time:'Yesterday, 4pm'}] },
      { id:4, name:'Personnel Form',          ref:'HR-209',   type:'HR',      dept:'HR Admin',         date:'Yesterday',        by:'C. Dela Rosa', status:'Pending',  icon:'warn',
        timeline:[{c:'#FCD34D',t:'<strong>Submitted</strong> by C. Dela Rosa',time:'Yesterday, 2:08 PM'},{c:'#93C5FD',t:'<strong>Routed</strong> to HR Admin',time:'Yesterday, 2:09 PM'}] },
      { id:5, name:'Policy Draft v3',         ref:'DRAFT-071',type:'Admin',   dept:"Director's Office",date:'2 days ago',       by:'J. Reyes',    status:'Returned',  icon:'red',
        timeline:[{c:'#86EFAC',t:'<strong>Submitted</strong> by J. Reyes',time:'3 days ago'},{c:'#93C5FD',t:'<strong>Reviewed</strong> by Director\'s Office',time:'2 days ago, 3pm'},{c:'#FCA5A5',t:'<strong>Returned</strong> — incomplete signatories',time:'2 days ago, 4:15 PM'}] },
      { id:6, name:'Q3 Financial Report',     ref:'ARCH-030', type:'Archive', dept:'Storage',          date:'3 days ago',       by:'M. Santos',   status:'Archived',  icon:'gray',
        timeline:[{c:'#86EFAC',t:'<strong>Approved</strong> and archived',time:'3 days ago'},{c:'#D1D5DB',t:'<strong>Encrypted</strong> and stored',time:'3 days ago'}] },
      { id:7, name:'Budget Proposal FY2025',  ref:'FIN-088',  type:'Finance', dept:'Finance Dept.',    date:'3 days ago',       by:'R. Tan',      status:'Approved',  icon:'green',
        timeline:[{c:'#86EFAC',t:'<strong>Approved</strong> by Finance Director',time:'3 days ago'}] },
      { id:8, name:'Supplier Agreement',      ref:'CONT-019', type:'Legal',   dept:'Legal Team',       date:'4 days ago',       by:'B. Lim',      status:'In Review', icon:'blue',
        timeline:[{c:'#93C5FD',t:'<strong>Under review</strong> by Legal Team',time:'4 days ago'}] },
      { id:9, name:'Leave Request Form',      ref:'HR-210',   type:'HR',      dept:'HR Admin',         date:'4 days ago',       by:'P. Villanueva',status:'Approved', icon:'green',
        timeline:[{c:'#86EFAC',t:'<strong>Approved</strong> by HR Admin',time:'4 days ago'}] },
      { id:10,name:'Equipment Request',       ref:'REQ-002',  type:'Finance', dept:'Finance Dept.',    date:'5 days ago',       by:'L. Garcia',   status:'Pending',   icon:'warn',
        timeline:[{c:'#FCD34D',t:'<strong>Submitted</strong> by L. Garcia',time:'5 days ago'},{c:'#93C5FD',t:'<strong>Routed</strong> to Finance Dept.',time:'5 days ago'}] },
      { id:11,name:'Annual Review Report',    ref:'ARCH-031', type:'Archive', dept:'Storage',          date:'6 days ago',       by:'J. Reyes',    status:'Archived',  icon:'gray',
        timeline:[{c:'#86EFAC',t:'<strong>Archived</strong> after approval',time:'6 days ago'}] },
      { id:12,name:'NDA — External Partner',  ref:'CONT-020', type:'Legal',   dept:'Legal Team',       date:'1 week ago',       by:'A. Cruz',     status:'Approved',  icon:'green',
        timeline:[{c:'#86EFAC',t:'<strong>Approved</strong> and filed',time:'1 week ago'}] },
    ];

    const ICON_COLORS = {
      warn:  { bg:'var(--warn-bg)',    stroke:'#B45309' },
      blue:  { bg:'var(--info-bg)',    stroke:'#1E40AF' },
      green: { bg:'var(--accent-bg)',  stroke:'#2D6A4F' },
      red:   { bg:'var(--danger-bg)',  stroke:'#B91C1C' },
      gray:  { bg:'var(--gray-bg)',    stroke:'#6B7280' },
    };
    const STATUS_PILL = {
      'Pending':   'pill-amber',
      'In Review': 'pill-blue',
      'Approved':  'pill-green',
      'Returned':  'pill-red',
      'Archived':  'pill-gray',
    };

    let currentStatus = '';
    let currentPage = 1;
    const PER_PAGE = 10;
    let sortKey = 'name';
    let sortDir = 1;
    let selected = new Set();

    function getFiltered() {
      const q = document.getElementById('searchInput').value.toLowerCase();
      const type = document.getElementById('typeFilter').value;
      const dept = document.getElementById('deptFilter').value;
      return ALL_DOCS.filter(d => {
        const matchQ = !q || d.name.toLowerCase().includes(q) || d.ref.toLowerCase().includes(q) || d.dept.toLowerCase().includes(q);
        const matchType = !type || d.type === type;
        const matchDept = !dept || d.dept === dept;
        const matchStatus = !currentStatus || d.status === currentStatus;
        return matchQ && matchType && matchDept && matchStatus;
      });
    }

    function getSorted(docs) {
      return [...docs].sort((a, b) => {
        const map = { name:'name', type:'type', dept:'dept', date:'id', status:'status' };
        const key = map[sortKey] || 'name';
        return (a[key] > b[key] ? 1 : -1) * sortDir;
      });
    }

    function iconSvg(color) {
      const icons = {
        warn:  `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="${color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>`,
        blue:  `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="${color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`,
        green: `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="${color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>`,
        red:   `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="${color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>`,
        gray:  `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="${color}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>`,
      };
      return icons[Object.keys(icons).find(k => color.includes(ICON_COLORS[k]?.stroke.replace('#','').toLowerCase())) || 'gray'] || icons.gray;
    }

    function actionBtn(doc) {
      const map = { 'Pending':'Review', 'In Review':'View', 'Approved':'View', 'Returned':'Revise', 'Archived':'View' };
      const cls = doc.status === 'Pending' || doc.status === 'Returned' ? 'row-btn accent' : 'row-btn';
      return `<button class="${cls}" onclick="event.stopPropagation();openDrawer(${doc.id})">${map[doc.status]} →</button>`;
    }

    function renderTable() {
      const filtered = getFiltered();
      const sorted = getSorted(filtered);
      const total = sorted.length;
      const maxPage = Math.max(1, Math.ceil(total / PER_PAGE));
      if (currentPage > maxPage) currentPage = maxPage;
      const slice = sorted.slice((currentPage-1)*PER_PAGE, currentPage*PER_PAGE);

      const tbody = document.getElementById('docTbody');
      if (slice.length === 0) {
        tbody.innerHTML = `<tr class="empty-row"><td colspan="7">No documents found.</td></tr>`;
      } else {
        tbody.innerHTML = slice.map(d => {
          const ic = ICON_COLORS[d.icon];
          const checked = selected.has(d.id) ? 'checked' : '';
          return `<tr onclick="openDrawer(${d.id})">
            <td style="padding-left:18px;" onclick="event.stopPropagation()">
              <input type="checkbox" class="cb" ${checked} onchange="toggleRow(${d.id},this)" />
            </td>
            <td>
              <div class="td-doc">
                <div class="td-doc-icon" style="background:${ic.bg};">${iconSvg2(d.icon, ic.stroke)}</div>
                <div>
                  <div class="td-doc-name">${d.name}</div>
                  <div class="td-doc-ref">${d.ref}</div>
                </div>
              </div>
            </td>
            <td class="td-small">${d.type}</td>
            <td class="td-name">${d.dept}</td>
            <td class="td-small">${d.date}</td>
            <td><span class="pill ${STATUS_PILL[d.status]}">${d.status}</span></td>
            <td style="text-align:right;padding-right:18px;">
              <div class="row-actions">${actionBtn(d)}</div>
            </td>
          </tr>`;
        }).join('');
      }

      // pagination
      document.getElementById('pagInfo').textContent = total === 0 ? 'No results' :
        `Showing ${(currentPage-1)*PER_PAGE+1}–${Math.min(currentPage*PER_PAGE,total)} of ${total}`;
      document.getElementById('prevBtn').disabled = currentPage <= 1;
      document.getElementById('nextBtn').disabled = currentPage >= maxPage;
      document.getElementById('page1').classList.toggle('active', currentPage === 1);
      document.getElementById('page2').classList.toggle('active', currentPage === 2);
      document.getElementById('page2').style.display = maxPage >= 2 ? '' : 'none';

      // update tab counts
      updateCounts();
      updateBulkBar();
    }

    function iconSvg2(type, stroke) {
      const icons = {
        warn:  `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="${stroke}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>`,
        blue:  `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="${stroke}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`,
        green: `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="${stroke}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>`,
        red:   `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="${stroke}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>`,
        gray:  `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="${stroke}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>`,
      };
      return icons[type] || icons.gray;
    }

    function updateCounts() {
      const counts = { '':0, 'Pending':0, 'In Review':0, 'Approved':0, 'Returned':0, 'Archived':0 };
      ALL_DOCS.forEach(d => { counts['']++; counts[d.status]++; });
      document.getElementById('count-all').textContent = counts[''];
      document.getElementById('count-pending').textContent = counts['Pending'];
      document.getElementById('count-review').textContent = counts['In Review'];
      document.getElementById('count-approved').textContent = counts['Approved'];
      document.getElementById('count-returned').textContent = counts['Returned'];
      document.getElementById('count-archived').textContent = counts['Archived'];
    }

    function setStatus(el, status) {
      currentStatus = status;
      currentPage = 1;
      document.querySelectorAll('.status-tab').forEach(t => t.classList.remove('active'));
      el.classList.add('active');
      renderTable();
    }

    function filterDocs() { currentPage = 1; renderTable(); }

    function sortBy(key) {
      if (sortKey === key) sortDir *= -1; else { sortKey = key; sortDir = 1; }
      ['name','type','dept','date','status'].forEach(k => {
        const el = document.getElementById('sort-'+k);
        if (el) { el.className = 'sort-icon' + (k === sortKey ? ' active' : ''); el.textContent = k === sortKey ? (sortDir === 1 ? '↑' : '↓') : '↕'; }
      });
      renderTable();
    }

    function toggleRow(id, cb) {
      if (cb.checked) selected.add(id); else selected.delete(id);
      updateBulkBar();
    }

    function toggleAll(cb) {
      const filtered = getFiltered();
      const slice = getSorted(filtered).slice((currentPage-1)*PER_PAGE, currentPage*PER_PAGE);
      slice.forEach(d => cb.checked ? selected.add(d.id) : selected.delete(d.id));
      renderTable();
    }

    function clearSelection() { selected.clear(); renderTable(); }

    function updateBulkBar() {
      const bar = document.getElementById('bulkBar');
      const n = selected.size;
      if (n > 0) { bar.classList.add('visible'); document.getElementById('bulkText').textContent = `${n} selected`; }
      else bar.classList.remove('visible');
    }

    function changePage(dir) { currentPage += dir; renderTable(); }
    function goPage(p) { currentPage = p; renderTable(); }

    // DRAWER
    function openDrawer(id) {
      if (id === 'new') {
        document.getElementById('drawerTitle').textContent = 'Upload New Document';
        document.getElementById('drawerRef').textContent = 'Fill in document details';
        document.getElementById('dRef').textContent = '—';
        document.getElementById('dType').textContent = '—';
        document.getElementById('dDept').textContent = '—';
        document.getElementById('dDate').textContent = '—';
        document.getElementById('dBy').textContent = '—';
        document.getElementById('dStatus').innerHTML = '—';
        document.getElementById('drawerTimeline').innerHTML = '<p style="font-size:12px;color:var(--muted);">No history yet.</p>';
      } else {
        const doc = ALL_DOCS.find(d => d.id === id);
        if (!doc) return;
        document.getElementById('drawerTitle').textContent = doc.name;
        document.getElementById('drawerRef').textContent = `${doc.ref} · ${doc.type}`;
        document.getElementById('dRef').textContent = doc.ref;
        document.getElementById('dType').textContent = doc.type;
        document.getElementById('dDept').textContent = doc.dept;
        document.getElementById('dDate').textContent = doc.date;
        document.getElementById('dBy').textContent = doc.by;
        document.getElementById('dStatus').innerHTML = `<span class="pill ${STATUS_PILL[doc.status]}">${doc.status}</span>`;
        document.getElementById('drawerTimeline').innerHTML = doc.timeline.map(t =>
          `<div class="timeline-item">
            <div class="timeline-dot" style="background:${t.c};"></div>
            <div><div class="timeline-text">${t.t}</div><div class="timeline-time">${t.time}</div></div>
          </div>`).join('');
      }
      document.getElementById('drawer').classList.add('open');
      document.getElementById('drawerOverlay').classList.add('open');
    }

    function closeDrawer() {
      document.getElementById('drawer').classList.remove('open');
      document.getElementById('drawerOverlay').classList.remove('open');
    }

    // INIT
    renderTable();
  </script>
</body>
</html>