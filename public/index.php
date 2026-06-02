<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DocuTrack — Document Tracking System</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;1,400&family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet" />
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }

    :root {
      --cream: #FAF9F7;
      --white: #FFFFFF;
      --ink: #1C1C1A;
      --ink2: #3D3D3A;
      --muted: #8C8C88;
      --border: #E8E6E1;
      --border2: #D4D1CB;
      --accent: #2D6A4F;
      --accent-light: #52B788;
      --accent-bg: #EEF7F2;
      --accent-border: #C3E6D4;
      --warn: #B45309;
      --warn-bg: #FEF3C7;
      --danger: #B91C1C;
      --danger-bg: #FEE2E2;
      --info: #1E40AF;
      --info-bg: #EFF6FF;
    }

    body {
      background: var(--cream);
      color: var(--ink);
      font-family: 'Instrument Sans', sans-serif;
      font-size: 15px;
      line-height: 1.7;
      -webkit-font-smoothing: antialiased;
    }

    h1, h2, h3 { font-family: 'Lora', serif; font-weight: 600; color: var(--ink); line-height: 1.2; letter-spacing: -0.01em; }

    /* NAV */
    nav {
      position: sticky; top: 0; z-index: 100;
      background: rgba(250,249,247,0.92);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid var(--border);
    }
    .nav-inner {
      max-width: 1120px; margin: 0 auto; padding: 0 32px;
      height: 64px; display: flex; align-items: center; justify-content: space-between;
    }
    .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
    .logo-icon {
      width: 34px; height: 34px; background: var(--accent); border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
    }
    .logo-name { font-family: 'Lora', serif; font-size: 18px; font-weight: 600; color: var(--ink); letter-spacing: -0.02em; }
    .nav-links { display: flex; gap: 28px; }
    .nav-links a { font-size: 14px; font-weight: 500; color: var(--muted); text-decoration: none; transition: color 0.15s; }
    .nav-links a:hover { color: var(--ink); }
    .nav-actions { display: flex; gap: 10px; align-items: center; }
    .btn-ghost {
      background: transparent; border: 1px solid var(--border2); color: var(--ink2);
      padding: 8px 18px; border-radius: 8px; font-size: 14px; font-weight: 500;
      cursor: pointer; font-family: 'Instrument Sans', sans-serif;
      transition: background 0.15s, border-color 0.15s;
    }
    .btn-ghost:hover { background: var(--white); border-color: var(--border2); }
    .btn-primary {
      background: var(--accent); color: #fff; border: none;
      padding: 8px 18px; border-radius: 8px; font-size: 14px; font-weight: 600;
      cursor: pointer; font-family: 'Instrument Sans', sans-serif;
      transition: background 0.15s; letter-spacing: 0.01em;
    }
    .btn-primary:hover { background: #235C42; }

    /* HERO */
    .hero {
      max-width: 1120px; margin: 0 auto; padding: 96px 32px 80px;
      display: grid; grid-template-columns: 1fr 1fr; gap: 72px; align-items: center;
    }
    .hero-eyebrow {
      display: inline-flex; align-items: center; gap: 7px;
      font-size: 12px; font-weight: 600; color: var(--accent);
      letter-spacing: 0.07em; text-transform: uppercase; margin-bottom: 20px;
    }
    .live-dot {
      width: 7px; height: 7px; background: var(--accent-light); border-radius: 50%;
      position: relative;
    }
    .live-dot::after {
      content: ''; position: absolute; inset: -3px;
      background: rgba(82,183,136,0.3); border-radius: 50%;
      animation: pulse 2s infinite;
    }
    @keyframes pulse { 0%, 100% { transform: scale(1); opacity: 0.6; } 50% { transform: scale(1.6); opacity: 0; } }
    h1 { font-size: clamp(36px, 4.5vw, 56px); margin-bottom: 18px; }
    h1 em { font-style: italic; color: var(--accent); }
    .hero-sub { font-size: 16px; color: var(--muted); max-width: 420px; line-height: 1.8; margin-bottom: 32px; }
    .hero-btns { display: flex; gap: 10px; flex-wrap: wrap; }
    .hero-btns .btn-primary { padding: 11px 26px; font-size: 15px; }
    .hero-btns .btn-ghost { padding: 11px 26px; font-size: 15px; }

    /* DOCUMENT CARD PREVIEW */
    .doc-preview {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 16px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.06), 0 1px 4px rgba(0,0,0,0.04);
      overflow: hidden;
    }
    .doc-preview-header {
      padding: 14px 20px;
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
      background: var(--cream);
    }
    .doc-preview-title { font-size: 13px; font-weight: 600; color: var(--ink2); }
    .doc-preview-body { padding: 6px 0; }
    .doc-item {
      display: flex; align-items: center; justify-content: space-between;
      padding: 13px 20px;
      border-bottom: 1px solid var(--border);
      transition: background 0.15s;
    }
    .doc-item:last-child { border-bottom: none; }
    .doc-item:hover { background: var(--cream); }
    .doc-item-left { display: flex; align-items: center; gap: 12px; }
    .doc-thumb {
      width: 36px; height: 36px; border-radius: 8px;
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .doc-item-name { font-size: 13px; font-weight: 600; color: var(--ink); }
    .doc-item-meta { font-size: 12px; color: var(--muted); margin-top: 1px; }
    .pill {
      font-size: 11px; font-weight: 600; padding: 3px 10px;
      border-radius: 20px; white-space: nowrap; letter-spacing: 0.02em;
    }
    .pill-green { background: var(--accent-bg); color: var(--accent); border: 1px solid var(--accent-border); }
    .pill-amber { background: var(--warn-bg); color: var(--warn); border: 1px solid #FDE68A; }
    .pill-blue  { background: var(--info-bg); color: var(--info); border: 1px solid #BFDBFE; }
    .pill-gray  { background: #F3F4F6; color: #6B7280; border: 1px solid #E5E7EB; }
    .pill-red   { background: var(--danger-bg); color: var(--danger); border: 1px solid #FECACA; }

    /* DIVIDER */
    hr.section-divider { border: none; border-top: 1px solid var(--border); max-width: 1120px; margin: 0 auto; }

    /* SECTIONS */
    .section-wrap { max-width: 1120px; margin: 0 auto; padding: 88px 32px; }
    .section-eyebrow { font-size: 12px; font-weight: 600; color: var(--accent); letter-spacing: 0.07em; text-transform: uppercase; margin-bottom: 12px; }
    h2 { font-size: clamp(26px, 3.5vw, 42px); margin-bottom: 14px; }
    .section-sub { font-size: 16px; color: var(--muted); max-width: 500px; line-height: 1.8; }
    .section-head { margin-bottom: 56px; }

    /* FEATURES */
    .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2px; background: var(--border); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; }
    .feat {
      background: var(--white); padding: 32px 28px;
      transition: background 0.15s;
    }
    .feat:hover { background: #FEFEFE; }
    .feat-icon {
      width: 42px; height: 42px; border-radius: 10px;
      background: var(--accent-bg); border: 1px solid var(--accent-border);
      display: flex; align-items: center; justify-content: center; margin-bottom: 16px;
    }
    .feat-title { font-family: 'Lora', serif; font-size: 15px; font-weight: 600; color: var(--ink); margin-bottom: 8px; }
    .feat-desc { font-size: 13px; color: var(--muted); line-height: 1.75; }

    /* WORKFLOW */
    .workflow-wrap { display: grid; grid-template-columns: 1fr 1fr; gap: 64px; align-items: start; }
    .step-row { display: flex; gap: 18px; margin-bottom: 32px; }
    .step-row:last-child { margin-bottom: 0; }
    .step-left { display: flex; flex-direction: column; align-items: center; }
    .step-circle {
      width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
      display: flex; align-items: center; justify-content: center;
      font-size: 12px; font-weight: 700; font-family: 'Instrument Sans', sans-serif;
    }
    .step-done { background: var(--accent-bg); border: 1.5px solid var(--accent-border); color: var(--accent); }
    .step-active { background: var(--accent); color: #fff; }
    .step-next { background: var(--white); border: 1.5px solid var(--border2); color: var(--muted); }
    .step-line { width: 1px; flex: 1; min-height: 24px; background: var(--border); margin: 5px 0; }
    .step-body { padding-top: 4px; }
    .step-title { font-family: 'Lora', serif; font-size: 15px; font-weight: 600; color: var(--ink); margin-bottom: 5px; }
    .step-desc { font-size: 13px; color: var(--muted); line-height: 1.75; }

    /* WORKFLOW SIDE CARDS */
    .side-card { background: var(--white); border: 1px solid var(--border); border-radius: 14px; padding: 20px; margin-bottom: 12px; }
    .side-card:last-child { margin-bottom: 0; }
    .side-card-title { font-size: 13px; font-weight: 600; color: var(--ink); margin-bottom: 14px; }
    .route-row { display: flex; align-items: center; justify-content: space-between; padding: 10px 12px; background: var(--cream); border: 1px solid var(--border); border-radius: 8px; margin-bottom: 8px; }
    .route-row:last-child { margin-bottom: 0; }
    .route-dept { font-size: 12px; color: var(--ink2); font-weight: 500; }
    .prog-row { margin-bottom: 10px; }
    .prog-row:last-child { margin-bottom: 0; }
    .prog-label { display: flex; justify-content: space-between; font-size: 12px; color: var(--muted); margin-bottom: 5px; }
    .prog-track { height: 4px; background: var(--border); border-radius: 2px; overflow: hidden; }
    .prog-fill { height: 100%; border-radius: 2px; background: var(--accent); }

    /* DASHBOARD MOCKUP */
    .dash-wrap { background: var(--white); border: 1px solid var(--border); border-radius: 20px; overflow: hidden; box-shadow: 0 8px 40px rgba(0,0,0,0.07); }
    .dash-topbar { background: var(--cream); border-bottom: 1px solid var(--border); padding: 14px 24px; display: flex; align-items: center; justify-content: space-between; }
    .dash-topbar-title { font-family: 'Lora', serif; font-size: 14px; font-weight: 600; color: var(--ink); }
    .dash-tabs { display: flex; gap: 4px; }
    .dash-tab { font-size: 12px; font-weight: 500; padding: 5px 12px; border-radius: 6px; cursor: pointer; color: var(--muted); }
    .dash-tab.active { background: var(--white); color: var(--ink); border: 1px solid var(--border); font-weight: 600; }
    .dash-body { padding: 24px; }
    .dash-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 20px; }
    .dash-metric { background: var(--cream); border: 1px solid var(--border); border-radius: 10px; padding: 14px 16px; }
    .dash-metric-label { font-size: 11px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 6px; }
    .dash-metric-val { font-family: 'Lora', serif; font-size: 22px; font-weight: 600; color: var(--ink); }
    .dash-metric-sub { font-size: 11px; color: var(--muted); margin-top: 3px; }
    .dash-cols { display: grid; grid-template-columns: 1fr 1.6fr; gap: 14px; }
    .dash-card { background: var(--cream); border: 1px solid var(--border); border-radius: 10px; padding: 16px; }
    .dash-card-title { font-size: 12px; font-weight: 600; color: var(--ink2); margin-bottom: 14px; text-transform: uppercase; letter-spacing: 0.04em; }
    /* chart */
    .bar-chart { display: flex; align-items: flex-end; gap: 5px; height: 72px; padding: 0 2px; }
    .bar-col { flex: 1; background: var(--accent-bg); border: 1px solid var(--accent-border); border-bottom: none; border-radius: 4px 4px 0 0; transition: background 0.2s; }
    .bar-col.peak { background: #C3E6D4; border-color: var(--accent-light); }
    /* table */
    .doc-table { width: 100%; border-collapse: collapse; }
    .doc-table th { font-size: 11px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em; padding: 0 10px 10px; text-align: left; border-bottom: 1px solid var(--border); }
    .doc-table td { font-size: 12px; padding: 10px; border-bottom: 1px solid var(--border); color: var(--ink2); }
    .doc-table tr:last-child td { border-bottom: none; }
    .doc-table tr:hover td { background: var(--cream); }
    .td-id { font-weight: 600; color: var(--ink); font-size: 12px; }

    /* CTA */
    .cta-box {
      background: var(--white); border: 1px solid var(--border);
      border-radius: 20px; padding: 72px 48px; text-align: center;
      position: relative; overflow: hidden;
    }
    .cta-box::before {
      content: ''; position: absolute; inset: 0;
      background: linear-gradient(160deg, var(--accent-bg) 0%, transparent 60%);
      pointer-events: none;
    }
    .cta-box h2 { margin-bottom: 14px; position: relative; }
    .cta-box p { color: var(--muted); font-size: 16px; margin-bottom: 32px; position: relative; }
    .cta-btns { display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; position: relative; }
    .cta-btns .btn-primary { padding: 12px 28px; font-size: 15px; }
    .cta-btns .btn-ghost { padding: 12px 28px; font-size: 15px; }

    /* FOOTER */
    footer { border-top: 1px solid var(--border); }
    .footer-inner { max-width: 1120px; margin: 0 auto; padding: 36px 32px; display: flex; align-items: center; justify-content: space-between; }
    .footer-copy { font-size: 13px; color: var(--muted); }
    .footer-links { display: flex; gap: 24px; }
    .footer-links a { font-size: 13px; color: var(--muted); text-decoration: none; transition: color 0.15s; }
    .footer-links a:hover { color: var(--ink); }

    /* ANIMATIONS */
    @keyframes fadeUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
    .fade-up { animation: fadeUp 0.5s ease both; }
    .d1 { animation-delay: 0.05s; } .d2 { animation-delay: 0.12s; }
    .d3 { animation-delay: 0.2s; } .d4 { animation-delay: 0.28s; }

    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: var(--cream); }
    ::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 3px; }

    @media (max-width: 860px) {
      .hero, .workflow-wrap { grid-template-columns: 1fr; gap: 40px; }
      .features-grid { grid-template-columns: 1fr; }
      .dash-grid { grid-template-columns: repeat(2,1fr); }
      .dash-cols { grid-template-columns: 1fr; }
      .nav-links { display: none; }
    }
  </style>
</head>
<body>

  <!-- NAV -->
  <nav>
    <div class="nav-inner">
      <a class="logo" href="#">
        <div class="logo-icon">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
            <line x1="9" y1="13" x2="15" y2="13"/>
            <line x1="9" y1="17" x2="15" y2="17"/>
          </svg>
        </div>
        <span class="logo-name">DocuTrack</span>
      </a>
      <div class="nav-links">
        <a href="#features">Features</a>
        <a href="#workflow">Workflow</a>
        <a href="#dashboard">Dashboard</a>
      </div>
      <div class="nav-actions">
        <button class="btn-ghost">Sign In</button>
        <button class="btn-primary">Get Started</button>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section>
    <div class="hero">
      <div class="fade-up">
        <div class="hero-eyebrow d1">
          <div class="live-dot"></div>
          System Online
        </div>
        <h1 class="d2">Track every document, <em>effortlessly.</em></h1>
        <p class="hero-sub d3">DocuTrack gives your team a clear, organized view of every document in motion — who has it, where it's going, and what still needs attention.</p>
        <div class="hero-btns d4">
          <button class="btn-primary">Get Started →</button>
          <button class="btn-ghost">View Documentation</button>
        </div>
      </div>

      <!-- DOCUMENT PREVIEW CARD -->
      <div class="fade-up d3">
        <div class="doc-preview">
          <div class="doc-preview-header">
            <span class="doc-preview-title">Document Queue</span>
            <span class="pill pill-green">Active</span>
          </div>
          <div class="doc-preview-body">

            <div class="doc-item">
              <div class="doc-item-left">
                <div class="doc-thumb" style="background:#EEF7F2;">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2D6A4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <div>
                  <div class="doc-item-name">Procurement Request</div>
                  <div class="doc-item-meta">Routed to Finance Department</div>
                </div>
              </div>
              <span class="pill pill-green">Approved</span>
            </div>

            <div class="doc-item">
              <div class="doc-item-left">
                <div class="doc-thumb" style="background:#FEF3C7;">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#B45309" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                  <div class="doc-item-name">Compliance Memo</div>
                  <div class="doc-item-meta">Awaiting Legal Team review</div>
                </div>
              </div>
              <span class="pill pill-amber">Pending</span>
            </div>

            <div class="doc-item">
              <div class="doc-item-left">
                <div class="doc-thumb" style="background:#EFF6FF;">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1E40AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
                <div>
                  <div class="doc-item-name">Policy Update Draft</div>
                  <div class="doc-item-meta">Director's Office — In Review</div>
                </div>
              </div>
              <span class="pill pill-blue">In Review</span>
            </div>

            <div class="doc-item">
              <div class="doc-item-left">
                <div class="doc-thumb" style="background:#F3F4F6;">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <div>
                  <div class="doc-item-name">Q3 Financial Reports</div>
                  <div class="doc-item-meta">Archived — Encrypted</div>
                </div>
              </div>
              <span class="pill pill-gray">Archived</span>
            </div>

            <div class="doc-item">
              <div class="doc-item-left">
                <div class="doc-thumb" style="background:#FEE2E2;">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#B91C1C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                </div>
                <div>
                  <div class="doc-item-name">Vendor Contract</div>
                  <div class="doc-item-meta">Returned — Incomplete signatories</div>
                </div>
              </div>
              <span class="pill pill-red">Returned</span>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <hr class="section-divider" />

  <!-- FEATURES -->
  <section id="features">
    <div class="section-wrap">
      <div class="section-head">
        <div class="section-eyebrow">Core Features</div>
        <h2>Everything your team<br/>needs to stay on track.</h2>
        <p class="section-sub">Built for organizations that need clarity, accountability, and a clean paper trail on every document.</p>
      </div>
      <div class="features-grid">
        <div class="feat">
          <div class="feat-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2D6A4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          </div>
          <div class="feat-title">Real-Time Tracking</div>
          <div class="feat-desc">See exactly where any document is in the process at any moment — no more chasing down approvals or guessing who has it.</div>
        </div>
        <div class="feat">
          <div class="feat-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2D6A4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
          </div>
          <div class="feat-title">Automated Routing</div>
          <div class="feat-desc">Set up routing rules once and let the system handle assignments, escalations, and reminders automatically.</div>
        </div>
        <div class="feat">
          <div class="feat-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2D6A4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          </div>
          <div class="feat-title">Access Control</div>
          <div class="feat-desc">Define who can view, edit, or approve each document type. Every action is logged for a clean audit trail.</div>
        </div>
        <div class="feat">
          <div class="feat-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2D6A4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
          </div>
          <div class="feat-title">Reports & Analytics</div>
          <div class="feat-desc">Understand bottlenecks, turnaround times, and department performance with clear, exportable reports.</div>
        </div>
        <div class="feat">
          <div class="feat-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2D6A4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/></svg>
          </div>
          <div class="feat-title">Smart Notifications</div>
          <div class="feat-desc">Notify the right people at the right time — when a document needs attention, is overdue, or changes status.</div>
        </div>
        <div class="feat">
          <div class="feat-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2D6A4F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
          </div>
          <div class="feat-title">API & Integrations</div>
          <div class="feat-desc">Connect DocuTrack to the tools your team already uses — via a clean REST API or our built-in integrations.</div>
        </div>
      </div>
    </div>
  </section>

  <hr class="section-divider" />

  <!-- WORKFLOW -->
  <section id="workflow">
    <div class="section-wrap">
      <div class="workflow-wrap">
        <div>
          <div class="section-eyebrow">How It Works</div>
          <h2 style="margin-bottom:14px;">A simple process<br/>from start to finish.</h2>
          <p class="section-sub" style="margin-bottom:44px;">DocuTrack keeps your documents moving through a clear, predictable lifecycle — with full visibility at every step.</p>

          <div>
            <div class="step-row">
              <div class="step-left">
                <div class="step-circle step-done">✓</div>
                <div class="step-line"></div>
              </div>
              <div class="step-body">
                <div class="step-title">Document Intake</div>
                <div class="step-desc">Upload, scan, or receive documents via email. The system classifies them automatically by type and department.</div>
              </div>
            </div>
            <div class="step-row">
              <div class="step-left">
                <div class="step-circle step-active">2</div>
                <div class="step-line"></div>
              </div>
              <div class="step-body">
                <div class="step-title">Routing & Assignment</div>
                <div class="step-desc">Documents are sent to the right person or department based on your routing rules — no manual sorting needed.</div>
              </div>
            </div>
            <div class="step-row">
              <div class="step-left">
                <div class="step-circle step-next">3</div>
                <div class="step-line"></div>
              </div>
              <div class="step-body">
                <div class="step-title">Review & Approval</div>
                <div class="step-desc">Reviewers get notified and can approve, request changes, or escalate — from any device, at any time.</div>
              </div>
            </div>
            <div class="step-row">
              <div class="step-left">
                <div class="step-circle step-next">4</div>
              </div>
              <div class="step-body">
                <div class="step-title">Archival & Compliance</div>
                <div class="step-desc">Finalized documents are encrypted and stored with full retention policy enforcement and audit-ready records.</div>
              </div>
            </div>
          </div>
        </div>

        <!-- SIDE CARDS -->
        <div style="padding-top:60px;">
          <div class="side-card">
            <div class="side-card-title">Current Routing — Document in Progress</div>
            <div class="route-row">
              <div class="doc-item-left" style="gap:10px;">
                <div class="doc-thumb" style="background:#EEF7F2;width:30px;height:30px;">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#2D6A4F" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <span style="font-size:13px;font-weight:600;color:var(--ink);">Procurement Form</span>
              </div>
              <span class="pill pill-blue">Routing</span>
            </div>
            <div style="display:flex;justify-content:space-around;padding:12px 4px 4px;">
              <div style="text-align:center;">
                <div style="font-size:11px;color:var(--muted);margin-bottom:6px;">Finance</div>
                <span class="pill pill-green" style="font-size:10px;">Done</span>
              </div>
              <div style="display:flex;align-items:center;padding-bottom:4px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#D4D1CB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
              </div>
              <div style="text-align:center;">
                <div style="font-size:11px;color:var(--muted);margin-bottom:6px;">Legal</div>
                <span class="pill pill-amber" style="font-size:10px;">Active</span>
              </div>
              <div style="display:flex;align-items:center;padding-bottom:4px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#D4D1CB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
              </div>
              <div style="text-align:center;">
                <div style="font-size:11px;color:var(--muted);margin-bottom:6px;">Director</div>
                <span class="pill pill-gray" style="font-size:10px;">Waiting</span>
              </div>
            </div>
          </div>

          <div class="side-card">
            <div class="side-card-title">Department Status</div>
            <div class="prog-row">
              <div class="prog-label"><span>Finance Dept.</span><span class="pill pill-green" style="font-size:10px;">On Track</span></div>
              <div class="prog-track"><div class="prog-fill" style="width:90%;"></div></div>
            </div>
            <div class="prog-row">
              <div class="prog-label"><span>Legal Team</span><span class="pill pill-amber" style="font-size:10px;">Behind</span></div>
              <div class="prog-track"><div class="prog-fill" style="width:60%;background:#D97706;"></div></div>
            </div>
            <div class="prog-row">
              <div class="prog-label"><span>HR & Admin</span><span class="pill pill-green" style="font-size:10px;">On Track</span></div>
              <div class="prog-track"><div class="prog-fill" style="width:95%;"></div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <hr class="section-divider" />

  <!-- DASHBOARD -->
  <section id="dashboard">
    <div class="section-wrap">
      <div class="section-head">
        <div class="section-eyebrow">Operations Dashboard</div>
        <h2>Everything in one place.</h2>
        <p class="section-sub">A calm, organized view of your entire document operation — updated in real time.</p>
      </div>

      <div class="dash-wrap">
        <div class="dash-topbar">
          <span class="dash-topbar-title">Operations Overview</span>
          <div class="dash-tabs">
            <div class="dash-tab active">Today</div>
            <div class="dash-tab">This Week</div>
            <div class="dash-tab">This Month</div>
          </div>
          <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--accent);font-weight:500;">
            <div class="live-dot"></div>
            Live
          </div>
        </div>
        <div class="dash-body">
          <div class="dash-grid">
            <div class="dash-metric">
              <div class="dash-metric-label">Documents Processed</div>
              <div class="dash-metric-val">—</div>
              <div class="dash-metric-sub">Updated in real time</div>
            </div>
            <div class="dash-metric">
              <div class="dash-metric-label">Pending Review</div>
              <div class="dash-metric-val">—</div>
              <div class="dash-metric-sub">Across all departments</div>
            </div>
            <div class="dash-metric">
              <div class="dash-metric-label">Avg. Turnaround</div>
              <div class="dash-metric-val">—</div>
              <div class="dash-metric-sub">From intake to approval</div>
            </div>
            <div class="dash-metric">
              <div class="dash-metric-label">SLA Compliance</div>
              <div class="dash-metric-val">—</div>
              <div class="dash-metric-sub">Based on configured rules</div>
            </div>
          </div>

          <div class="dash-cols">
            <div class="dash-card">
              <div class="dash-card-title">Activity Volume</div>
              <div class="bar-chart">
                <div class="bar-col" style="height:38%;"></div>
                <div class="bar-col" style="height:52%;"></div>
                <div class="bar-col" style="height:34%;"></div>
                <div class="bar-col" style="height:65%;"></div>
                <div class="bar-col peak" style="height:88%;"></div>
                <div class="bar-col" style="height:72%;"></div>
                <div class="bar-col" style="height:80%;"></div>
                <div class="bar-col" style="height:58%;"></div>
                <div class="bar-col" style="height:44%;"></div>
                <div class="bar-col" style="height:62%;"></div>
                <div class="bar-col" style="height:48%;"></div>
                <div class="bar-col" style="height:30%;"></div>
              </div>
            </div>
            <div class="dash-card">
              <div class="dash-card-title">Active Queue</div>
              <table class="doc-table">
                <thead>
                  <tr>
                    <th>Document</th>
                    <th>Type</th>
                    <th>Assigned To</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="td-id">Procurement Request</td>
                    <td>Finance</td>
                    <td>Finance Dept.</td>
                    <td><span class="pill pill-amber">Pending</span></td>
                  </tr>
                  <tr>
                    <td class="td-id">Internal Memo</td>
                    <td>Internal</td>
                    <td>Director</td>
                    <td><span class="pill pill-blue">In Review</span></td>
                  </tr>
                  <tr>
                    <td class="td-id">Vendor Contract</td>
                    <td>Legal</td>
                    <td>Legal Team</td>
                    <td><span class="pill pill-green">Approved</span></td>
                  </tr>
                  <tr>
                    <td class="td-id">Personnel Form</td>
                    <td>HR</td>
                    <td>HR Admin</td>
                    <td><span class="pill pill-amber">Pending</span></td>
                  </tr>
                  <tr>
                    <td class="td-id">Q3 Report</td>
                    <td>Archive</td>
                    <td>Storage</td>
                    <td><span class="pill pill-gray">Archived</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <hr class="section-divider" />

  <!-- CTA -->
  <section>
    <div class="section-wrap" style="padding-top:72px;padding-bottom:72px;">
      <div class="cta-box">
        <div class="section-eyebrow" style="margin-bottom:16px;">Get Started</div>
        <h2>Ready to bring order<br/>to your documents?</h2>
        <p>Set up in minutes. No complicated configuration required.</p>
        <div class="cta-btns">
          <button class="btn-primary">Get Started →</button>
          <button class="btn-ghost">Schedule a Demo</button>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="footer-inner">
      <span class="footer-copy">© 2025 DocuTrack — Document Tracking System</span>
      <div class="footer-links">
        <a href="#">Privacy</a>
        <a href="#">Terms</a>
        <a href="#">Security</a>
        <a href="#">Documentation</a>
        <a href="#">Support</a>
      </div>
    </div>
  </footer>

</body>
</html>