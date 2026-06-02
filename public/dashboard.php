<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DocuTrack — Dashboard</title>
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
      width: var(--sidebar-w);
      min-height: 100vh;
      background: var(--white);
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; left: 0;
      z-index: 50;
    }
    .sidebar-logo {
      padding: 0 20px;
      height: var(--topbar-h);
      display: flex;
      align-items: center;
      gap: 10px;
      border-bottom: 1px solid var(--border);
      text-decoration: none;
    }
    .logo-icon {
      width: 32px; height: 32px;
      background: var(--accent);
      border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .logo-name {
      font-family: 'Lora', serif;
      font-size: 16px; font-weight: 600;
      color: var(--ink); letter-spacing: -0.02em;
    }
    .sidebar-section { padding: 20px 12px 8px; }
    .sidebar-label {
      font-size: 10px; font-weight: 600; color: var(--muted);
      letter-spacing: 0.08em; text-transform: uppercase;
      padding: 0 8px; margin-bottom: 4px;
    }
    .nav-item {
      display: flex; align-items: center; gap: 10px;
      padding: 8px 10px; border-radius: 8px;
      font-size: 13px; font-weight: 500; color: var(--ink2);
      cursor: pointer; text-decoration: none;
      transition: background 0.12s, color 0.12s;
      margin-bottom: 1px;
    }
    .nav-item:hover { background: var(--cream); color: var(--ink); }
    .nav-item.active { background: var(--accent-bg); color: var(--accent); font-weight: 600; }
    .nav-item svg { flex-shrink: 0; opacity: 0.7; }
    .nav-item.active svg { opacity: 1; }
    .nav-badge {
      margin-left: auto;
      font-size: 10px; font-weight: 700;
      background: var(--warn-bg); color: var(--warn);
      border: 1px solid var(--warn-border);
      padding: 1px 7px; border-radius: 10px;
    }
    .nav-badge.green {
      background: var(--accent-bg); color: var(--accent);
      border-color: var(--accent-border);
    }
    .sidebar-bottom {
      margin-top: auto;
      padding: 16px 12px;
      border-top: 1px solid var(--border);
    }
    .user-row {
      display: flex; align-items: center; gap: 10px;
      padding: 8px 10px; border-radius: 8px;
      cursor: pointer; transition: background 0.12s;
    }
    .user-row:hover { background: var(--cream); }
    .avatar {
      width: 32px; height: 32px; border-radius: 50%;
      background: var(--accent-bg); border: 1.5px solid var(--accent-border);
      display: flex; align-items: center; justify-content: center;
      font-size: 12px; font-weight: 700; color: var(--accent);
      flex-shrink: 0;
    }
    .user-name { font-size: 13px; font-weight: 600; color: var(--ink); }
    .user-role { font-size: 11px; color: var(--muted); }

    /* ── MAIN ── */
    .main {
      margin-left: var(--sidebar-w);
      flex: 1;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* TOPBAR */
    .topbar {
      height: var(--topbar-h);
      background: var(--white);
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 28px;
      position: sticky; top: 0; z-index: 40;
    }
    .topbar-left { display: flex; align-items: center; gap: 16px; }
    .topbar-title { font-family: 'Lora', serif; font-size: 16px; font-weight: 600; color: var(--ink); }
    .breadcrumb { font-size: 12px; color: var(--muted); }
    .breadcrumb span { color: var(--ink2); }
    .topbar-right { display: flex; align-items: center; gap: 10px; }
    .topbar-btn {
      background: var(--white); border: 1px solid var(--border2);
      color: var(--ink2); padding: 6px 14px; border-radius: 7px;
      font-size: 13px; font-weight: 500; cursor: pointer;
      font-family: 'Instrument Sans', sans-serif;
      display: flex; align-items: center; gap: 6px;
      transition: background 0.12s;
    }
    .topbar-btn:hover { background: var(--cream); }
    .topbar-btn.primary {
      background: var(--accent); color: #fff; border-color: var(--accent);
    }
    .topbar-btn.primary:hover { background: var(--accent-hover); }
    .notif-btn {
      width: 34px; height: 34px; border-radius: 8px;
      background: var(--white); border: 1px solid var(--border);
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; transition: background 0.12s; position: relative;
    }
    .notif-btn:hover { background: var(--cream); }
    .notif-dot {
      width: 7px; height: 7px; background: var(--warn);
      border-radius: 50%; position: absolute; top: 6px; right: 6px;
      border: 1.5px solid var(--white);
    }

    /* CONTENT */
    .content { padding: 28px; flex: 1; }

    /* STATUS PILLS */
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

    /* METRIC CARDS */
    .metrics-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 24px; }
    .metric-card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 18px 20px;
    }
    .metric-label { font-size: 11px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 8px; }
    .metric-val { font-family: 'Lora', serif; font-size: 28px; font-weight: 600; color: var(--ink); line-height: 1; margin-bottom: 6px; }
    .metric-sub { font-size: 12px; color: var(--muted); }
    .metric-icon {
      float: right; margin-top: -4px;
      width: 36px; height: 36px; border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
    }

    /* TWO-COL LAYOUT */
    .two-col { display: grid; grid-template-columns: 1fr 1.7fr; gap: 16px; margin-bottom: 16px; }
    .three-col { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 16px; }

    /* CARDS */
    .card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 12px;
      overflow: hidden;
    }
    .card-header {
      padding: 14px 18px;
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
    }
    .card-title { font-size: 13px; font-weight: 600; color: var(--ink); }
    .card-action { font-size: 12px; color: var(--accent); font-weight: 500; cursor: pointer; }
    .card-action:hover { text-decoration: underline; }
    .card-body { padding: 16px 18px; }
    .card-body-flush { padding: 0; }

    /* ACTIVITY CHART */
    .bar-chart { display: flex; align-items: flex-end; gap: 5px; height: 88px; padding: 0 2px; }
    .bar-col {
      flex: 1; background: var(--accent-bg);
      border: 1px solid var(--accent-border);
      border-bottom: none; border-radius: 4px 4px 0 0;
      transition: background 0.15s;
      cursor: pointer;
    }
    .bar-col:hover { background: #C3E6D4; }
    .bar-col.peak { background: #C3E6D4; border-color: var(--accent-light); }
    .bar-labels { display: flex; gap: 5px; padding: 4px 2px 0; }
    .bar-label { flex: 1; text-align: center; font-size: 9px; color: var(--muted); }

    /* QUEUE TABLE */
    .doc-table { width: 100%; border-collapse: collapse; }
    .doc-table th {
      font-size: 10px; font-weight: 600; color: var(--muted);
      text-transform: uppercase; letter-spacing: 0.06em;
      padding: 0 16px 10px; text-align: left;
      border-bottom: 1px solid var(--border);
    }
    .doc-table td { padding: 11px 16px; border-bottom: 1px solid var(--border); font-size: 13px; color: var(--ink2); }
    .doc-table tr:last-child td { border-bottom: none; }
    .doc-table tr:hover td { background: var(--cream); }
    .td-doc { display: flex; align-items: center; gap: 10px; }
    .td-doc-icon { width: 30px; height: 30px; border-radius: 7px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .td-doc-name { font-weight: 600; color: var(--ink); font-size: 13px; }
    .td-doc-id { font-size: 11px; color: var(--muted); margin-top: 1px; }
    .td-muted { color: var(--muted); font-size: 12px; }

    /* DEPT STATUS */
    .dept-row { display: flex; align-items: center; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--border); }
    .dept-row:last-child { border-bottom: none; }
    .dept-name { font-size: 13px; font-weight: 600; color: var(--ink); margin-bottom: 4px; }
    .dept-sub { font-size: 11px; color: var(--muted); }
    .dept-prog { width: 100px; }
    .prog-track { height: 4px; background: var(--border); border-radius: 2px; overflow: hidden; margin-top: 5px; }
    .prog-fill { height: 100%; border-radius: 2px; }

    /* RECENT ACTIVITY FEED */
    .feed-item { display: flex; align-items: flex-start; gap: 12px; padding: 11px 0; border-bottom: 1px solid var(--border); }
    .feed-item:last-child { border-bottom: none; }
    .feed-dot { width: 8px; height: 8px; border-radius: 50%; margin-top: 4px; flex-shrink: 0; }
    .feed-text { font-size: 13px; color: var(--ink2); line-height: 1.5; }
    .feed-text strong { color: var(--ink); font-weight: 600; }
    .feed-time { font-size: 11px; color: var(--muted); margin-top: 2px; }

    /* QUICK ACTIONS */
    .action-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
    .action-btn {
      display: flex; align-items: center; gap: 10px;
      padding: 12px 14px; border-radius: 9px;
      border: 1px solid var(--border); background: var(--cream);
      cursor: pointer; transition: background 0.12s, border-color 0.12s;
      text-decoration: none;
    }
    .action-btn:hover { background: var(--white); border-color: var(--border2); }
    .action-btn-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .action-btn-label { font-size: 12px; font-weight: 600; color: var(--ink); }
    .action-btn-sub { font-size: 11px; color: var(--muted); margin-top: 1px; }

    /* SCROLLBAR */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: var(--cream); }
    ::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 3px; }

    /* FADE IN */
    @keyframes fadeUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .content > * { animation: fadeUp 0.35s ease both; }
    .content > *:nth-child(1) { animation-delay: 0.04s; }
    .content > *:nth-child(2) { animation-delay: 0.08s; }
    .content > *:nth-child(3) { animation-delay: 0.12s; }
    .content > *:nth-child(4) { animation-delay: 0.16s; }
  </style>
</head>
<body>

  <aside class="sidebar">
    <a class="sidebar-logo" href="dashboard.php">
      <div class="logo-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
          <polyline points="14 2 14 8 20 8"/>
          <line x1="9" y1="13" x2="15" y2="13"/>
          <line x1="9" y1="17" x2="15" y2="17"/>
        </svg>
      </div>
      <span class="logo-name">DocuTrack</span>
    </a>

    <div class="sidebar-section">
      <div class="sidebar-label">Main</div>
      <a class="nav-item active" href="dashboard.php">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        Overview
      </a>
      <a class="nav-item" href="documents.php">
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
      <div class="topbar-left">
        <div>
          <div class="topbar-title">Overview</div>
          <div class="breadcrumb">DocuTrack / <span>Dashboard</span></div>
        </div>
      </div>
      <div class="topbar-right">
        <div class="notif-btn">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6B6B67" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3z"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
          <div class="notif-dot"></div>
        </div>
        <button class="topbar-btn">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          Search
        </button>
        <button class="topbar-btn primary">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Upload Document
        </button>
      </div>
    </header>

    <div class="content">

      <div class="metrics-row">
        <div class="metric-card">
          <div class="metric-icon" style="background:var(--accent-bg);">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2D6A4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          </div>
          <div class="metric-label">Total Documents</div>
          <div class="metric-val">—</div>
          <div class="metric-sub">In the system</div>
        </div>
        <div class="metric-card">
          <div class="metric-icon" style="background:var(--warn-bg);">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#B45309" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          </div>
          <div class="metric-label">Pending Review</div>
          <div class="metric-val">—</div>
          <div class="metric-sub">Awaiting action</div>
        </div>
        <div class="metric-card">
          <div class="metric-icon" style="background:var(--accent-bg);">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2D6A4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <div class="metric-label">Approved Today</div>
          <div class="metric-val">—</div>
          <div class="metric-sub">Cleared & routed</div>
        </div>
        <div class="metric-card">
          <div class="metric-icon" style="background:var(--danger-bg);">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#B91C1C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
          </div>
          <div class="metric-label">Returned</div>
          <div class="metric-val">—</div>
          <div class="metric-sub">Needs correction</div>
        </div>
      </div>

      <div class="two-col">
        <div class="card">
          <div class="card-header">
            <span class="card-title">Activity Volume</span>
            <div style="display:flex;gap:4px;">
              <span style="font-size:11px;font-weight:600;padding:3px 10px;border-radius:6px;background:var(--accent-bg);color:var(--accent);border:1px solid var(--accent-border);cursor:pointer;">Today</span>
              <span style="font-size:11px;font-weight:500;padding:3px 10px;border-radius:6px;color:var(--muted);cursor:pointer;">Week</span>
            </div>
          </div>
          <div class="card-body">
            <div class="bar-chart">
              <div class="bar-col" style="height:32%;"></div>
              <div class="bar-col" style="height:48%;"></div>
              <div class="bar-col" style="height:38%;"></div>
              <div class="bar-col" style="height:60%;"></div>
              <div class="bar-col peak" style="height:85%;"></div>
              <div class="bar-col" style="height:70%;"></div>
              <div class="bar-col" style="height:78%;"></div>
              <div class="bar-col" style="height:55%;"></div>
              <div class="bar-col" style="height:42%;"></div>
              <div class="bar-col" style="height:58%;"></div>
              <div class="bar-col" style="height:46%;"></div>
              <div class="bar-col" style="height:28%;"></div>
            </div>
            <div class="bar-labels">
              <div class="bar-label">8am</div>
              <div class="bar-label">9</div>
              <div class="bar-label">10</div>
              <div class="bar-label">11</div>
              <div class="bar-label">12</div>
              <div class="bar-label">1pm</div>
              <div class="bar-label">2</div>
              <div class="bar-label">3</div>
              <div class="bar-label">4</div>
              <div class="bar-label">5</div>
              <div class="bar-label">6</div>
              <div class="bar-label">7</div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <span class="card-title">Quick Actions</span>
          </div>
          <div class="card-body">
            <div class="action-grid">
              <a class="action-btn" href="#">
                <div class="action-btn-icon" style="background:var(--accent-bg);">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#2D6A4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </div>
                <div>
                  <div class="action-btn-label">Upload Document</div>
                  <div class="action-btn-sub">Add to the queue</div>
                </div>
              </a>
              <a class="action-btn" href="#">
                <div class="action-btn-icon" style="background:var(--info-bg);">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#1E40AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                </div>
                <div>
                  <div class="action-btn-label">Set Routing Rule</div>
                  <div class="action-btn-sub">Automate a workflow</div>
                </div>
              </a>
              <a class="action-btn" href="#">
                <div class="action-btn-icon" style="background:var(--warn-bg);">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#B45309" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                  <div class="action-btn-label">View Pending</div>
                  <div class="action-btn-sub">Items needing action</div>
                </div>
              </a>
              <a class="action-btn" href="#">
                <div class="action-btn-icon" style="background:var(--gray-bg);">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                </div>
                <div>
                  <div class="action-btn-label">Export Report</div>
                  <div class="action-btn-sub">Download as PDF or CSV</div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="card" style="margin-bottom:16px;">
        <div class="card-header">
          <span class="card-title">Document Queue</span>
          <span class="card-action">View all →</span>
        </div>
        <div class="card-body-flush">
          <table class="doc-table">
            <thead>
              <tr>
                <th style="padding-left:18px;">Document</th>
                <th>Type</th>
                <th>Assigned To</th>
                <th>Submitted</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="td-doc">
                    <div class="td-doc-icon" style="background:var(--warn-bg);">
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#B45309" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div>
                      <div class="td-doc-name">Procurement Request</div>
                      <div class="td-doc-id">REQ-001</div>
                    </div>
                  </div>
                </td>
                <td class="td-muted">Finance</td>
                <td class="td-muted">Finance Dept.</td>
                <td class="td-muted">Today, 9:14 AM</td>
                <td><span class="pill pill-amber">Pending</span></td>
                <td style="text-align:right;padding-right:18px;"><span style="font-size:12px;color:var(--accent);font-weight:500;cursor:pointer;">Review →</span></td>
              </tr>
              <tr>
                <td>
                  <div class="td-doc">
                    <div class="td-doc-icon" style="background:var(--info-bg);">
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#1E40AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                    <div>
                      <div class="td-doc-name">Compliance Memo</div>
                      <div class="td-doc-id">MEMO-044</div>
                    </div>
                  </div>
                </td>
                <td class="td-muted">Legal</td>
                <td class="td-muted">Legal Team</td>
                <td class="td-muted">Today, 8:50 AM</td>
                <td><span class="pill pill-blue">In Review</span></td>
                <td style="text-align:right;padding-right:18px;"><span style="font-size:12px;color:var(--accent);font-weight:500;cursor:pointer;">View →</span></td>
              </tr>
              <tr>
                <td>
                  <div class="td-doc">
                    <div class="td-doc-icon" style="background:var(--accent-bg);">
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#2D6A4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div>
                      <div class="td-doc-name">Vendor Contract</div>
                      <div class="td-doc-id">CONT-018</div>
                    </div>
                  </div>
                </td>
                <td class="td-muted">Legal</td>
                <td class="td-muted">Legal Team</td>
                <td class="td-muted">Yesterday</td>
                <td><span class="pill pill-green">Approved</span></td>
                <td style="text-align:right;padding-right:18px;"><span style="font-size:12px;color:var(--accent);font-weight:500;cursor:pointer;">View →</span></td>
              </tr>
              <tr>
                <td>
                  <div class="td-doc">
                    <div class="td-doc-icon" style="background:var(--warn-bg);">
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#B45309" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div>
                      <div class="td-doc-name">Personnel Form</div>
                      <div class="td-doc-id">HR-209</div>
                    </div>
                  </div>
                </td>
                <td class="td-muted">HR</td>
                <td class="td-muted">HR Admin</td>
                <td class="td-muted">Yesterday</td>
                <td><span class="pill pill-amber">Pending</span></td>
                <td style="text-align:right;padding-right:18px;"><span style="font-size:12px;color:var(--accent);font-weight:500;cursor:pointer;">Review →</span></td>
              </tr>
              <tr>
                <td>
                  <div class="td-doc">
                    <div class="td-doc-icon" style="background:var(--danger-bg);">
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#B91C1C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    </div>
                    <div>
                      <div class="td-doc-name">Policy Draft v3</div>
                      <div class="td-doc-id">DRAFT-071</div>
                    </div>
                  </div>
                </td>
                <td class="td-muted">Admin</td>
                <td class="td-muted">Director's Office</td>
                <td class="td-muted">2 days ago</td>
                <td><span class="pill pill-red">Returned</span></td>
                <td style="text-align:right;padding-right:18px;"><span style="font-size:12px;color:var(--accent);font-weight:500;cursor:pointer;">Revise →</span></td>
              </tr>
              <tr>
                <td>
                  <div class="td-doc">
                    <div class="td-doc-icon" style="background:var(--gray-bg);">
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                    <div>
                      <div class="td-doc-name">Q3 Financial Report</div>
                      <div class="td-doc-id">ARCH-030</div>
                    </div>
                  </div>
                </td>
                <td class="td-muted">Finance</td>
                <td class="td-muted">Storage</td>
                <td class="td-muted">3 days ago</td>
                <td><span class="pill pill-gray">Archived</span></td>
                <td style="text-align:right;padding-right:18px;"><span style="font-size:12px;color:var(--accent);font-weight:500;cursor:pointer;">View →</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="three-col" style="margin-bottom:0;">
        <div class="card" style="grid-column: span 1;">
          <div class="card-header">
            <span class="card-title">Department Status</span>
          </div>
          <div class="card-body">
            <div class="dept-row">
              <div>
                <div class="dept-name">Finance</div>
                <div class="dept-sub">Documents in queue</div>
              </div>
              <div style="text-align:right;">
                <span class="pill pill-green">On Track</span>
                <div class="prog-track" style="width:80px;margin-top:6px;margin-left:auto;">
                  <div class="prog-fill" style="width:88%;background:var(--accent);"></div>
                </div>
              </div>
            </div>
            <div class="dept-row">
              <div>
                <div class="dept-name">Legal</div>
                <div class="dept-sub">Documents in queue</div>
              </div>
              <div style="text-align:right;">
                <span class="pill pill-amber">Behind</span>
                <div class="prog-track" style="width:80px;margin-top:6px;margin-left:auto;">
                  <div class="prog-fill" style="width:55%;background:#D97706;"></div>
                </div>
              </div>
            </div>
            <div class="dept-row">
              <div>
                <div class="dept-name">HR & Admin</div>
                <div class="dept-sub">Documents in queue</div>
              </div>
              <div style="text-align:right;">
                <span class="pill pill-green">On Track</span>
                <div class="prog-track" style="width:80px;margin-top:6px;margin-left:auto;">
                  <div class="prog-fill" style="width:94%;background:var(--accent);"></div>
                </div>
              </div>
            </div>
            <div class="dept-row">
              <div>
                <div class="dept-name">Director's Office</div>
                <div class="dept-sub">Documents in queue</div>
              </div>
              <div style="text-align:right;">
                <span class="pill pill-blue">Active</span>
                <div class="prog-track" style="width:80px;margin-top:6px;margin-left:auto;">
                  <div class="prog-fill" style="width:72%;background:#1E40AF;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card" style="grid-column: span 2;">
          <div class="card-header">
            <span class="card-title">Recent Activity</span>
            <span class="card-action">View all →</span>
          </div>
          <div class="card-body">
            <div class="feed-item">
              <div class="feed-dot" style="background:var(--accent-light);"></div>
              <div>
                <div class="feed-text"><strong>Vendor Contract (CONT-018)</strong> was approved by the Legal Team.</div>
                <div class="feed-time">Today, 10:32 AM</div>
              </div>
            </div>
            <div class="feed-item">
              <div class="feed-dot" style="background:#FBBF24;"></div>
              <div>
                <div class="feed-text"><strong>Compliance Memo (MEMO-044)</strong> was routed to the Legal Team for review.</div>
                <div class="feed-time">Today, 8:50 AM</div>
              </div>
            </div>
            <div class="feed-item">
              <div class="feed-dot" style="background:#FCA5A5;"></div>
              <div>
                <div class="feed-text"><strong>Policy Draft v3 (DRAFT-071)</strong> was returned — incomplete signatory section.</div>
                <div class="feed-time">Yesterday, 4:15 PM</div>
              </div>
            </div>
            <div class="feed-item">
              <div class="feed-dot" style="background:var(--accent-light);"></div>
              <div>
                <div class="feed-text"><strong>Q3 Financial Report (ARCH-030)</strong> was archived and encrypted.</div>
                <div class="feed-time">3 days ago</div>
              </div>
            </div>
            <div class="feed-item">
              <div class="feed-dot" style="background:#93C5FD;"></div>
              <div>
                <div class="feed-text"><strong>Personnel Form (HR-209)</strong> was submitted and routed to HR Admin.</div>
                <div class="feed-time">Yesterday, 2:08 PM</div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div></div></body>
</html>