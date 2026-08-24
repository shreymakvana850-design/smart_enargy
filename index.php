<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Smart Energy Monitoring System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<style>
:root{
  --white:#ffffff;--gray-50:#f8fafc;--gray-100:#f1f5f9;--gray-200:#e2e8f0;
  --gray-300:#cbd5e1;--gray-400:#94a3b8;--gray-500:#64748b;--gray-600:#475569;
  --gray-700:#334155;--gray-800:#1e293b;--gray-900:#0f172a;--gray-950:#0a0e1a;
  --blue-50:#eff6ff;--blue-100:#dbeafe;--blue-200:#bfdbfe;--blue-300:#93c5fd;
  --blue-400:#60a5fa;--blue-500:#3b82f6;--blue-600:#2563eb;--blue-700:#1d4ed8;
  --blue-800:#1e40af;--blue-900:#1e3a8a;--blue-950:#172554;
  --red-400:#f87171;--red-500:#ef4444;--red-600:#dc2626;
  --amber-400:#fbbf24;--amber-500:#f59e0b;--amber-600:#d97706;
  --emerald-400:#34d399;--emerald-500:#10b981;
  --shadow-sm:0 1px 2px rgba(0,0,0,.3);--shadow:0 1px 3px rgba(0,0,0,.4),0 1px 2px rgba(0,0,0,.3);
  --shadow-md:0 4px 6px -1px rgba(0,0,0,.5),0 2px 4px -2px rgba(0,0,0,.4);
  --shadow-lg:0 10px 15px -3px rgba(0,0,0,.5),0 4px 6px -4px rgba(0,0,0,.4);
  --shadow-xl:0 20px 25px -5px rgba(0,0,0,.5),0 8px 10px -6px rgba(0,0,0,.4);
  --radius:12px;--radius-lg:16px;--radius-xl:20px;
  --sidebar-w:260px;--header-h:68px;
  --font-primary:'Plus Jakarta Sans',sans-serif;
  --font-display:'Space Grotesk',sans-serif;
  --card-bg:rgba(30,41,59,.7);--card-border:rgba(51,65,85,.5);
  --input-bg:rgba(15,23,42,.8);--input-border:rgba(51,65,85,.6);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html{scroll-behavior:smooth;}
body{font-family:var(--font-primary);background:var(--gray-950);color:var(--gray-300);overflow-x:hidden;line-height:1.6;}
h1,h2,h3,h4,h5,h6{font-family:var(--font-display);font-weight:700;line-height:1.2;color:var(--white);}
::-webkit-scrollbar{width:6px;height:6px;}
::-webkit-scrollbar-track{background:transparent;}
::-webkit-scrollbar-thumb{background:var(--gray-700);border-radius:3px;}
::-webkit-scrollbar-thumb:hover{background:var(--gray-600);}

/* ===== HEADER ===== */
.top-header{position:fixed;top:0;left:0;right:0;height:var(--header-h);background:rgba(15,23,42,.92);backdrop-filter:blur(20px);border-bottom:1px solid var(--card-border);z-index:1040;display:flex;align-items:center;justify-content:space-between;padding:0 24px;}
.header-left{display:flex;align-items:center;gap:14px;}
.header-left .brand-icon{width:42px;height:42px;background:linear-gradient(135deg,var(--blue-500),var(--blue-700));border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:18px;flex-shrink:0;box-shadow:0 0 20px rgba(59,130,246,.3);}
.header-left .project-name{font-size:15px;font-weight:800;color:var(--white);font-family:var(--font-display);line-height:1.3;}
.header-right{display:flex;align-items:center;gap:20px;}
.esp-status-badge{display:flex;align-items:center;gap:8px;padding:6px 14px;border-radius:50px;font-size:12px;font-weight:600;transition:all .3s;}
.esp-status-badge.connected{background:rgba(16,185,129,.1);color:var(--emerald-400);border:1px solid rgba(16,185,129,.2);}
.esp-status-badge.disconnected{background:rgba(239,68,68,.1);color:var(--red-400);border:1px solid rgba(239,68,68,.2);}
.status-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0;}
.status-dot.online{background:var(--emerald-500);box-shadow:0 0 0 3px rgba(16,185,129,.25);animation:pulse-dot 2s infinite;}
.status-dot.offline{background:var(--red-500);box-shadow:0 0 0 3px rgba(239,68,68,.25);}
@keyframes pulse-dot{0%,100%{box-shadow:0 0 0 3px rgba(16,185,129,.25);}50%{box-shadow:0 0 0 8px rgba(16,185,129,0);}}
.esp-meta{font-size:11px;color:var(--gray-500);font-weight:400;}
.hamburger{display:none;background:none;border:none;font-size:20px;color:var(--gray-400);cursor:pointer;padding:4px;}

/* ===== SIDEBAR ===== */
.sidebar{position:fixed;top:var(--header-h);left:0;bottom:0;width:var(--sidebar-w);background:linear-gradient(180deg,#060a14 0%,#0c1322 100%);z-index:1050;overflow-y:auto;transition:transform .3s cubic-bezier(.4,0,.2,1);display:flex;flex-direction:column;border-right:1px solid var(--card-border);}
.sidebar-nav{padding:16px 12px;flex:1;}
.sidebar-nav .nav-label{font-size:10px;font-weight:700;color:rgba(255,255,255,.2);text-transform:uppercase;letter-spacing:1.2px;padding:16px 14px 8px;}
.sidebar-nav .nav-item{margin-bottom:2px;}
.sidebar-nav .nav-link{display:flex;align-items:center;gap:12px;padding:10px 14px;border-radius:10px;color:rgba(255,255,255,.45);font-size:13.5px;font-weight:500;transition:all .2s;text-decoration:none;position:relative;}
.sidebar-nav .nav-link:hover{color:rgba(255,255,255,.8);background:rgba(59,130,246,.06);}
.sidebar-nav .nav-link.active{color:#fff;background:rgba(59,130,246,.12);font-weight:600;}
.sidebar-nav .nav-link.active::before{content:'';position:absolute;left:0;top:50%;transform:translateY(-50%);width:3px;height:20px;background:var(--blue-500);border-radius:0 3px 3px 0;box-shadow:0 0 10px rgba(59,130,246,.5);}
.sidebar-nav .nav-link i{width:20px;text-align:center;font-size:14px;}
.sidebar-footer{padding:16px 20px;border-top:1px solid rgba(255,255,255,.05);font-size:11px;color:rgba(255,255,255,.15);text-align:center;}
.sidebar-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:1045;backdrop-filter:blur(4px);}

/* ===== MAIN ===== */
.main-content{margin-left:var(--sidebar-w);margin-top:var(--header-h);padding:24px;min-height:calc(100vh - var(--header-h));transition:margin-left .3s;}
.page-section{display:none;animation:fadeInPage .35s ease;}
.page-section.active{display:block;}
@keyframes fadeInPage{from{opacity:0;transform:translateY(8px);}to{opacity:1;transform:translateY(0);}}

/* ===== CARDS ===== */
.card-custom{border:1px solid var(--card-border);border-radius:var(--radius-lg);box-shadow:var(--shadow);background:var(--card-bg);backdrop-filter:blur(10px);overflow:hidden;transition:all .25s;}
.card-custom:hover{box-shadow:var(--shadow-lg);border-color:rgba(59,130,246,.2);}
.card-body{padding:20px;}
.card-header-custom{padding:16px 20px;border-bottom:1px solid var(--card-border);display:flex;align-items:center;justify-content:space-between;gap:12px;}
.card-header-custom h5{font-size:15px;font-weight:700;margin:0;color:var(--white);}
.card-header-custom .badge-count{font-size:11px;font-weight:600;padding:3px 10px;border-radius:50px;}

/* ===== STAT CARDS ===== */
.stat-card{position:relative;padding:20px 20px 16px;border-radius:var(--radius-lg);background:var(--card-bg);border:1px solid var(--card-border);box-shadow:var(--shadow);transition:all .25s;overflow:hidden;backdrop-filter:blur(10px);}
.stat-card:hover{box-shadow:var(--shadow-lg);transform:translateY(-3px);border-color:rgba(59,130,246,.25);}
.stat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;border-radius:var(--radius-lg) var(--radius-lg) 0 0;}
.stat-card.voltage::before{background:linear-gradient(90deg,var(--blue-400),var(--blue-600));}
.stat-card.current::before{background:linear-gradient(90deg,var(--emerald-400),var(--emerald-500));}
.stat-card.power::before{background:linear-gradient(90deg,var(--amber-400),var(--amber-600));}
.stat-card.energy::before{background:linear-gradient(90deg,#a78bfa,#7c3aed);}
.stat-card.cost::before{background:linear-gradient(90deg,#fb923c,#ea580c);}
.stat-card.carbon::before{background:linear-gradient(90deg,var(--gray-400),var(--gray-500));}
.stat-card .stat-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:18px;margin-bottom:12px;}
.stat-card.voltage .stat-icon{background:rgba(59,130,246,.12);color:var(--blue-400);}
.stat-card.current .stat-icon{background:rgba(16,185,129,.12);color:var(--emerald-400);}
.stat-card.power .stat-icon{background:rgba(245,158,11,.12);color:var(--amber-400);}
.stat-card.energy .stat-icon{background:rgba(167,139,250,.12);color:#a78bfa;}
.stat-card.cost .stat-icon{background:rgba(251,146,60,.12);color:#fb923c;}
.stat-card.carbon .stat-icon{background:rgba(148,163,184,.1);color:var(--gray-400);}
.stat-card .stat-label{font-size:12px;font-weight:600;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;}
.stat-card .stat-value{font-family:var(--font-display);font-size:28px;font-weight:800;color:var(--white);line-height:1.1;}
.stat-card .stat-unit{font-size:14px;font-weight:500;color:var(--gray-500);margin-left:2px;}
.stat-card .stat-change{font-size:11px;font-weight:600;margin-top:6px;display:flex;align-items:center;gap:4px;}
.stat-card .stat-change.up{color:var(--red-400);}
.stat-card .stat-change.down{color:var(--emerald-400);}

/* ===== DEVICE STATUS ===== */
.device-status-card{background:linear-gradient(135deg,rgba(23,37,84,.6),rgba(10,14,26,.8));border:1px solid rgba(59,130,246,.15);border-radius:var(--radius-lg);color:#fff;overflow:hidden;position:relative;backdrop-filter:blur(10px);}
.device-status-card::after{content:'';position:absolute;top:-40px;right:-40px;width:160px;height:160px;background:rgba(59,130,246,.06);border-radius:50%;}
.device-status-card .device-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;position:relative;z-index:1;}
.device-status-card .device-title{font-size:14px;font-weight:700;color:var(--gray-400);text-transform:uppercase;letter-spacing:.8px;}
.device-status-card .device-badge{padding:4px 12px;border-radius:50px;font-size:11px;font-weight:700;}
.device-status-card .device-badge.online{background:rgba(16,185,129,.15);color:var(--emerald-400);border:1px solid rgba(16,185,129,.2);}
.device-status-card .device-badge.offline{background:rgba(239,68,68,.15);color:var(--red-400);border:1px solid rgba(239,68,68,.2);}
.device-info-row{display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid rgba(255,255,255,.05);font-size:13px;position:relative;z-index:1;}
.device-info-row:last-child{border-bottom:none;}
.device-info-row .label{color:var(--gray-500);font-weight:500;}
.device-info-row .value{color:var(--white);font-weight:600;}

/* ===== EFFICIENCY ===== */
.efficiency-card{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:28px 20px;}
.efficiency-svg{width:140px;height:140px;margin-bottom:12px;}
.efficiency-svg .bg-ring{fill:none;stroke:rgba(255,255,255,.06);stroke-width:10;}
.efficiency-svg .fg-ring{fill:none;stroke:var(--blue-500);stroke-width:10;stroke-linecap:round;transition:stroke-dashoffset 1s ease,stroke .3s;}
.efficiency-score-num{font-family:var(--font-display);font-size:32px;font-weight:800;fill:var(--white);}
.efficiency-score-label{font-size:11px;font-weight:700;fill:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;}
.efficiency-text{font-size:14px;font-weight:700;color:var(--white);}
.efficiency-subtext{font-size:11px;color:var(--gray-500);margin-top:2px;}

/* ===== CHARTS ===== */
.chart-wrap{position:relative;width:100%;padding:4px;}
.chart-wrap canvas{width:100%!important;}

/* ===== FILTERS ===== */
.filter-group{display:flex;flex-wrap:wrap;gap:6px;}
.filter-btn{padding:6px 16px;border-radius:50px;border:1px solid var(--card-border);background:var(--card-bg);font-size:12px;font-weight:600;color:var(--gray-400);cursor:pointer;transition:all .2s;}
.filter-btn:hover{border-color:var(--blue-500);color:var(--blue-400);}
.filter-btn.active{background:var(--blue-600);color:#fff;border-color:var(--blue-600);}

/* ===== AI CARD ===== */
.ai-card{background:linear-gradient(135deg,rgba(15,23,42,.9),rgba(30,41,59,.8));border:1px solid rgba(59,130,246,.15);border-radius:var(--radius-lg);color:#fff;position:relative;overflow:hidden;backdrop-filter:blur(10px);}
.ai-card::before{content:'';position:absolute;top:0;left:0;right:0;bottom:0;background:linear-gradient(135deg,rgba(59,130,246,.05),transparent);pointer-events:none;}
.ai-card .ai-header{display:flex;align-items:center;gap:12px;margin-bottom:20px;position:relative;z-index:1;}
.ai-card .ai-icon{width:40px;height:40px;border-radius:10px;background:linear-gradient(135deg,var(--blue-500),var(--blue-700));display:flex;align-items:center;justify-content:center;font-size:18px;box-shadow:0 0 20px rgba(59,130,246,.3);}
.ai-card .ai-title{font-size:16px;font-weight:700;font-family:var(--font-display);}
.ai-prediction-item{padding:14px 16px;background:rgba(255,255,255,.03);border-radius:10px;margin-bottom:8px;border:1px solid rgba(255,255,255,.05);position:relative;z-index:1;}
.ai-prediction-item .pred-label{font-size:11px;color:var(--gray-500);font-weight:500;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;}
.ai-prediction-item .pred-value{font-family:var(--font-display);font-size:20px;font-weight:800;}
.ai-prediction-item .pred-value.blue{color:var(--blue-400);}
.ai-prediction-item .pred-value.amber{color:var(--amber-400);}
.ai-prediction-item .pred-value.purple{color:#a78bfa;}
.ai-trend-badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:50px;font-size:11px;font-weight:700;margin-top:4px;}
.ai-trend-badge.up{background:rgba(239,68,68,.12);color:var(--red-400);}
.ai-trend-badge.down{background:rgba(16,185,129,.12);color:var(--emerald-400);}
.ai-trend-badge.stable{background:rgba(59,130,246,.12);color:var(--blue-400);}
.ai-recommendation{padding:14px 16px;background:rgba(59,130,246,.06);border:1px solid rgba(59,130,246,.12);border-radius:10px;font-size:13px;color:var(--gray-300);line-height:1.6;position:relative;z-index:1;}
.ai-recommendation i{color:var(--blue-400);margin-right:6px;}

/* ===== ALERTS ===== */
.alert-item{display:flex;align-items:flex-start;gap:12px;padding:14px 16px;border-radius:10px;margin-bottom:8px;border:1px solid;transition:all .2s;}
.alert-item.warning{background:rgba(245,158,11,.06);border-color:rgba(245,158,11,.15);}
.alert-item.critical{background:rgba(239,68,68,.06);border-color:rgba(239,68,68,.15);}
.alert-item.success{background:rgba(16,185,129,.06);border-color:rgba(16,185,129,.15);}
.alert-item .alert-icon{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0;}
.alert-item.warning .alert-icon{background:rgba(245,158,11,.12);color:var(--amber-500);}
.alert-item.critical .alert-icon{background:rgba(239,68,68,.12);color:var(--red-500);}
.alert-item.success .alert-icon{background:rgba(16,185,129,.12);color:var(--emerald-500);}
.alert-item .alert-text{font-size:13px;font-weight:600;color:var(--gray-300);}
.alert-item .alert-time{font-size:11px;color:var(--gray-600);margin-top:2px;}

/* ===== APPLIANCE ===== */
.appliance-card{padding:16px;border:1px solid var(--card-border);border-radius:var(--radius);transition:all .25s;background:var(--card-bg);backdrop-filter:blur(10px);}
.appliance-card.on{border-color:rgba(59,130,246,.3);background:linear-gradient(135deg,rgba(59,130,246,.08),var(--card-bg));}
.appliance-card .app-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;}
.appliance-card .app-name{font-size:14px;font-weight:700;display:flex;align-items:center;gap:8px;color:var(--white);}
.appliance-card .app-name i{font-size:18px;color:var(--gray-500);}
.appliance-card.on .app-name i{color:var(--blue-400);}
.appliance-card .app-status{font-size:11px;font-weight:700;padding:3px 10px;border-radius:50px;}
.appliance-card.on .app-status{background:rgba(59,130,246,.15);color:var(--blue-400);}
.appliance-card.off .app-status{background:rgba(255,255,255,.04);color:var(--gray-600);}
.appliance-card .app-stats{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:14px;}
.appliance-card .app-stat{font-size:11px;color:var(--gray-500);}
.appliance-card .app-stat span{display:block;font-size:14px;font-weight:700;color:var(--gray-200);}
.toggle-switch{position:relative;width:48px;height:26px;cursor:pointer;}
.toggle-switch input{display:none;}
.toggle-switch .slider{position:absolute;inset:0;background:var(--gray-700);border-radius:13px;transition:.3s;}
.toggle-switch .slider::before{content:'';position:absolute;left:3px;top:3px;width:20px;height:20px;background:#fff;border-radius:50%;transition:.3s;box-shadow:var(--shadow-sm);}
.toggle-switch input:checked+.slider{background:var(--blue-600);}
.toggle-switch input:checked+.slider::before{transform:translateX(22px);}

/* ===== TABLE ===== */
.table-custom{width:100%;font-size:13px;color:var(--gray-300);}
.table-custom thead th{background:rgba(15,23,42,.6);border-bottom:2px solid var(--card-border);font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--gray-500);padding:12px 14px;white-space:nowrap;}
.table-custom tbody td{padding:11px 14px;border-bottom:1px solid rgba(51,65,85,.3);vertical-align:center;color:var(--gray-300);}
.table-custom tbody tr:hover{background:rgba(59,130,246,.04);}
.table-responsive{overflow-x:auto;border-radius:var(--radius);border:1px solid var(--card-border);}

/* ===== PAGINATION ===== */
.pagination-custom{display:flex;align-items:center;gap:4px;justify-content:center;margin-top:16px;}
.pagination-custom .page-btn{width:34px;height:34px;border-radius:8px;border:1px solid var(--card-border);background:var(--card-bg);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;color:var(--gray-400);cursor:pointer;transition:all .2s;}
.pagination-custom .page-btn:hover{border-color:var(--blue-500);color:var(--blue-400);}
.pagination-custom .page-btn.active{background:var(--blue-600);color:#fff;border-color:var(--blue-600);}

/* ===== SETTINGS ===== */
.settings-group{padding:20px;border:1px solid var(--card-border);border-radius:var(--radius);margin-bottom:16px;background:var(--card-bg);backdrop-filter:blur(10px);}
.settings-group h6{font-size:14px;font-weight:700;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid var(--card-border);display:flex;align-items:center;gap:8px;color:var(--white);}
.settings-group h6 i{color:var(--blue-400);}
.form-control-custom{border:1px solid var(--input-border);border-radius:8px;padding:8px 14px;font-size:13px;font-family:var(--font-primary);transition:border-color .2s,box-shadow .2s;width:100%;background:var(--input-bg);color:var(--white);}
.form-control-custom:focus{outline:none;border-color:var(--blue-500);box-shadow:0 0 0 3px rgba(59,130,246,.15);}
.form-control-custom::placeholder{color:var(--gray-600);}

/* ===== BUTTONS ===== */
.btn-blue{background:var(--blue-600);color:#fff;border:none;padding:8px 20px;border-radius:8px;font-size:13px;font-weight:600;font-family:var(--font-primary);cursor:pointer;transition:all .2s;display:inline-flex;align-items:center;gap:6px;}
.btn-blue:hover{background:var(--blue-700);transform:translateY(-1px);box-shadow:0 0 20px rgba(59,130,246,.3);color:#fff;}
.btn-outline-blue{background:transparent;color:var(--blue-400);border:1px solid rgba(59,130,246,.3);padding:8px 20px;border-radius:8px;font-size:13px;font-weight:600;font-family:var(--font-primary);cursor:pointer;transition:all .2s;display:inline-flex;align-items:center;gap:6px;}
.btn-outline-blue:hover{background:rgba(59,130,246,.08);border-color:var(--blue-500);color:var(--blue-300);}
.btn-sm{padding:6px 14px;font-size:12px;border-radius:6px;}

/* ===== SAVING CARD ===== */
.saving-card{background:linear-gradient(135deg,var(--blue-900),var(--blue-950));border:1px solid rgba(59,130,246,.2);border-radius:var(--radius-lg);color:#fff;padding:24px;position:relative;overflow:hidden;backdrop-filter:blur(10px);}
.saving-card::after{content:'';position:absolute;bottom:-30px;right:-30px;width:120px;height:120px;background:rgba(59,130,246,.08);border-radius:50%;}
.saving-card h6{color:var(--blue-300);font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:.8px;margin-bottom:12px;}
.saving-card .saving-amount{font-family:var(--font-display);font-size:32px;font-weight:800;margin-bottom:12px;position:relative;z-index:1;color:var(--white);}
.saving-card ul{list-style:none;padding:0;margin:0;position:relative;z-index:1;}
.saving-card ul li{font-size:13px;padding:4px 0;color:rgba(255,255,255,.7);display:flex;align-items:flex-start;gap:8px;}
.saving-card ul li i{color:var(--blue-400);margin-top:3px;font-size:11px;}

/* ===== TOAST ===== */
.toast-container{position:fixed;top:80px;right:24px;z-index:9999;display:flex;flex-direction:column;gap:8px;}
.toast-msg{padding:12px 20px;border-radius:10px;font-size:13px;font-weight:600;box-shadow:var(--shadow-lg);animation:slideInToast .3s ease;display:flex;align-items:center;gap:10px;min-width:280px;backdrop-filter:blur(10px);}
.toast-msg.success{background:rgba(16,185,129,.9);color:#fff;}
.toast-msg.error{background:rgba(239,68,68,.9);color:#fff;}
.toast-msg.warning{background:rgba(245,158,11,.9);color:#fff;}
@keyframes slideInToast{from{opacity:0;transform:translateX(40px);}to{opacity:1;transform:translateX(0);}}

/* ===== LAST UPDATED ===== */
.last-updated-bar{font-size:11px;color:var(--gray-600);text-align:center;padding:8px;background:rgba(15,23,42,.5);border-radius:8px;margin-top:16px;display:flex;align-items:center;justify-content:center;gap:6px;}
.last-updated-bar .pulse{width:6px;height:6px;border-radius:50%;background:var(--blue-500);animation:pulse-dot-blue 2s infinite;}
@keyframes pulse-dot-blue{0%,100%{box-shadow:0 0 0 3px rgba(59,130,246,.3);}50%{box-shadow:0 0 0 8px rgba(59,130,246,0);}}

/* ===== FOOTER ===== */
.main-footer{margin-left:var(--sidebar-w);padding:20px 24px;text-align:center;font-size:12px;color:var(--gray-600);border-top:1px solid var(--card-border);background:rgba(15,23,42,.5);}

/* ===== REPORT CARDS ===== */
.report-card{padding:24px;border:1px solid var(--card-border);border-radius:var(--radius-lg);text-align:center;background:var(--card-bg);transition:all .25s;cursor:pointer;backdrop-filter:blur(10px);}
.report-card:hover{border-color:rgba(59,130,246,.3);box-shadow:var(--shadow-md);transform:translateY(-2px);}
.report-card .report-icon{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:22px;margin:0 auto 14px;background:rgba(59,130,246,.1);color:var(--blue-400);}
.report-card h6{font-size:14px;font-weight:700;color:var(--white);margin-bottom:4px;}
.report-card p{font-size:12px;color:var(--gray-500);margin:0;}

/* ===== BADGES ===== */
.badge-blue{background:rgba(59,130,246,.12);color:var(--blue-400);font-size:11px;font-weight:700;padding:3px 10px;border-radius:50px;}
.badge-red{background:rgba(239,68,68,.12);color:var(--red-400);font-size:11px;font-weight:700;padding:3px 10px;border-radius:50px;}
.badge-amber{background:rgba(245,158,11,.12);color:var(--amber-400);font-size:11px;font-weight:700;padding:3px 10px;border-radius:50px;}
.badge-green{background:rgba(16,185,129,.12);color:var(--emerald-400);font-size:11px;font-weight:700;padding:3px 10px;border-radius:50px;}

/* ===== MISC ===== */
.section-title{font-size:18px;font-weight:800;margin-bottom:16px;display:flex;align-items:center;gap:10px;color:var(--white);}
.section-title i{color:var(--blue-400);font-size:16px;}
.text-blue{color:var(--blue-400)!important;}
.divider{height:1px;background:var(--card-border);margin:20px 0;}
.fw-800{font-weight:800!important;}
.search-box{position:relative;}
.search-box input{padding-left:36px;}
.search-box i{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:var(--gray-600);font-size:13px;}

/* ===== RESPONSIVE ===== */
@media(max-width:991.98px){
  .sidebar{transform:translateX(-100%);}
  .sidebar.open{transform:translateX(0);}
  .sidebar-overlay.show{display:block;}
  .main-content,.main-footer{margin-left:0;}
  .hamburger{display:block;}
  .header-right .esp-meta{display:none;}
}
@media(max-width:767.98px){
  .main-content{padding:16px;}
  .stat-card .stat-value{font-size:22px;}
  .top-header{padding:0 16px;}
  .header-left .project-name{font-size:13px;}
}
@media(max-width:575.98px){
  .header-right .esp-status-badge span:not(.status-dot){display:none;}
  .stat-card{padding:14px;}
  .stat-card .stat-value{font-size:20px;}
}

/* ===== ANIMATIONS ===== */
@keyframes fadeUp{from{opacity:0;transform:translateY(16px);}to{opacity:1;transform:translateY(0);}}
.anim-delay-1{animation:fadeUp .5s ease .1s both;}
.anim-delay-2{animation:fadeUp .5s ease .2s both;}
.anim-delay-3{animation:fadeUp .5s ease .3s both;}
.anim-delay-4{animation:fadeUp .5s ease .4s both;}
.anim-delay-5{animation:fadeUp .5s ease .5s both;}
.anim-delay-6{animation:fadeUp .5s ease .6s both;}

/* ===== GLOW EFFECTS ===== */
.glow-blue{box-shadow:0 0 30px rgba(59,130,246,.15);}
.stat-card.voltage:hover{box-shadow:0 0 30px rgba(59,130,246,.1),var(--shadow-lg);}
.stat-card.current:hover{box-shadow:0 0 30px rgba(16,185,129,.1),var(--shadow-lg);}
.stat-card.power:hover{box-shadow:0 0 30px rgba(245,158,11,.1),var(--shadow-lg);}
.stat-card.energy:hover{box-shadow:0 0 30px rgba(167,139,250,.1),var(--shadow-lg);}
.stat-card.cost:hover{box-shadow:0 0 30px rgba(251,146,60,.1),var(--shadow-lg);}
</style>
</head>
<body>

<div class="toast-container" id="toastContainer"></div>

<!-- ===== HEADER ===== -->
<header class="top-header">
  <div class="header-left">
    <button class="hamburger" id="hamburgerBtn" aria-label="Toggle menu"><i class="fas fa-bars"></i></button>
    <div class="brand-icon"><i class="fas fa-bolt"></i></div>
    <div class="project-name">Smart Energy Monitoring & Intelligent Energy Management System</div>
  </div>
  <div class="header-right">
    <div class="esp-status-badge connected" id="headerEspBadge">
      <span class="status-dot online" id="headerDot"></span>
      <span id="headerEspText">ESP32 CONNECTED</span>
    </div>
    <div class="esp-meta" id="headerEspMeta">
      <div><i class="fas fa-wifi" style="margin-right:4px;"></i>Wi-Fi Connected</div>
      <div id="headerLastSeen">Last Seen: --</div>
    </div>
  </div>
</header>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- ===== SIDEBAR ===== -->
<nav class="sidebar" id="sidebar" aria-label="Main navigation">
  <div class="sidebar-nav">
    <div class="nav-label">Main</div>
    <div class="nav-item"><a href="#" class="nav-link active" data-page="dashboard"><i class="fas fa-th-large"></i>Dashboard</a></div>
    <div class="nav-item"><a href="#" class="nav-link" data-page="live-monitoring"><i class="fas fa-wave-square"></i>Live Monitoring</a></div>
    <div class="nav-item"><a href="#" class="nav-link" data-page="energy-analytics"><i class="fas fa-chart-bar"></i>Energy Analytics</a></div>
    <div class="nav-item"><a href="#" class="nav-link" data-page="historical-data"><i class="fas fa-database"></i>Historical Data</a></div>
    <div class="nav-label">Intelligence</div>
    <div class="nav-item"><a href="#" class="nav-link" data-page="ai-prediction"><i class="fas fa-robot"></i>AI Prediction</a></div>
    <div class="nav-item"><a href="#" class="nav-link" data-page="alerts"><i class="fas fa-bell"></i>Alerts</a></div>
    <div class="nav-label">Control</div>
    <div class="nav-item"><a href="#" class="nav-link" data-page="appliance-control"><i class="fas fa-sliders-h"></i>Appliance Control</a></div>
    <div class="nav-label">Reports</div>
    <div class="nav-item"><a href="#" class="nav-link" data-page="reports"><i class="fas fa-file-alt"></i>Reports</a></div>
    <div class="nav-label">System</div>
    <div class="nav-item"><a href="#" class="nav-link" data-page="settings"><i class="fas fa-cog"></i>Settings</a></div>
  </div>
  <div class="sidebar-footer">SEMS v1.0 &copy; 2025</div>
</nav>

<!-- ===== MAIN CONTENT ===== -->
<main class="main-content" id="mainContent">

  <!-- ===== DASHBOARD ===== -->
  <section class="page-section active" id="page-dashboard">
    <div class="row g-3 mb-4">
      <div class="col-xl-2 col-lg-4 col-md-4 col-6 anim-delay-1">
        <div class="stat-card voltage">
          <div class="stat-icon"><i class="fas fa-bolt"></i></div>
          <div class="stat-label">Voltage</div>
          <div class="stat-value"><span id="valVoltage">--</span><span class="stat-unit">V</span></div>
          <div class="stat-change down" id="changeVoltage"><i class="fas fa-arrow-down"></i> 0.2%</div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-4 col-md-4 col-6 anim-delay-2">
        <div class="stat-card current">
          <div class="stat-icon"><i class="fas fa-water"></i></div>
          <div class="stat-label">Current</div>
          <div class="stat-value"><span id="valCurrent">--</span><span class="stat-unit">A</span></div>
          <div class="stat-change down" id="changeCurrent"><i class="fas fa-arrow-down"></i> 1.1%</div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-4 col-md-4 col-6 anim-delay-3">
        <div class="stat-card power">
          <div class="stat-icon"><i class="fas fa-fire"></i></div>
          <div class="stat-label">Power</div>
          <div class="stat-value"><span id="valPower">--</span><span class="stat-unit">W</span></div>
          <div class="stat-change up" id="changePower"><i class="fas fa-arrow-up"></i> 3.5%</div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-4 col-md-4 col-6 anim-delay-4">
        <div class="stat-card energy">
          <div class="stat-icon"><i class="fas fa-charging-station"></i></div>
          <div class="stat-label">Energy</div>
          <div class="stat-value"><span id="valEnergy">--</span><span class="stat-unit">kWh</span></div>
          <div class="stat-change down" id="changeEnergy"><i class="fas fa-arrow-down"></i> 0.8%</div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-4 col-md-4 col-6 anim-delay-5">
        <div class="stat-card cost">
          <div class="stat-icon"><i class="fas fa-indian-rupee-sign"></i></div>
          <div class="stat-label">Est. Cost</div>
          <div class="stat-value"><span id="valCost">--</span></div>
          <div class="stat-change up" id="changeCost"><i class="fas fa-arrow-up"></i> 2.4%</div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-4 col-md-4 col-6 anim-delay-6">
        <div class="stat-card carbon">
          <div class="stat-icon"><i class="fas fa-cloud"></i></div>
          <div class="stat-label">Carbon</div>
          <div class="stat-value"><span id="valCarbon">--</span><span class="stat-unit">kg CO₂</span></div>
          <div class="stat-change down" id="changeCarbon"><i class="fas fa-arrow-down"></i> 0.5%</div>
        </div>
      </div>
    </div>

    <!-- ESP32 + Efficiency -->
    <div class="row g-3 mb-4">
      <div class="col-lg-8">
        <div class="card device-status-card">
          <div class="card-body">
            <div class="device-header">
              <span class="device-title"><i class="fas fa-microchip" style="margin-right:6px;"></i>ESP32 Device Status</span>
              <span class="device-badge online" id="deviceBadge">CONNECTED</span>
            </div>
            <div class="device-info-row"><span class="label">Device ID</span><span class="value" id="deviceId">ESP32_01</span></div>
            <div class="device-info-row"><span class="label">Wi-Fi Status</span><span class="value" id="deviceWifi">Connected</span></div>
            <div class="device-info-row"><span class="label">IP Address</span><span class="value" id="deviceIP">192.168.1.100</span></div>
            <div class="device-info-row"><span class="label">Last Seen</span><span class="value" id="deviceLastSeen">--</span></div>
            <div class="device-info-row"><span class="label">Heartbeat</span><span class="value" id="deviceHeartbeat">Active</span></div>
            <div class="device-info-row"><span class="label">Uptime</span><span class="value" id="deviceUptime">--</span></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card-custom efficiency-card" style="height:100%;">
          <div class="efficiency-svg">
            <svg viewBox="0 0 120 120" width="140" height="140">
              <circle class="bg-ring" cx="60" cy="60" r="50"/>
              <circle class="fg-ring" id="efficiencyRing" cx="60" cy="60" r="50" stroke-dasharray="314.16" stroke-dashoffset="40.84" transform="rotate(-90 60 60)"/>
              <text class="efficiency-score-num" x="60" y="58" text-anchor="middle" id="efficiencyNum">87</text>
              <text class="efficiency-score-label" x="60" y="74" text-anchor="middle" id="efficiencyLabel">GOOD</text>
            </svg>
          </div>
          <div class="efficiency-text">Energy Efficiency Score</div>
          <div class="efficiency-subtext">Based on real-time consumption</div>
        </div>
      </div>
    </div>

    <!-- Live Graph -->
    <div class="row g-3 mb-4">
      <div class="col-12">
        <div class="card-custom">
          <div class="card-header-custom">
            <h5><i class="fas fa-wave-square text-blue me-2"></i>Live Power Consumption</h5>
            <span class="badge-count badge-blue" id="liveGraphStatus">LIVE</span>
          </div>
          <div class="card-body">
            <div class="chart-wrap" style="height:280px;"><canvas id="livePowerChart"></canvas></div>
            <div class="last-updated-bar"><span class="pulse"></span> Last updated <span id="lastUpdatedText">--</span></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Breakdown + Alerts -->
    <div class="row g-3 mb-4">
      <div class="col-lg-7">
        <div class="card-custom">
          <div class="card-header-custom"><h5><i class="fas fa-chart-pie text-blue me-2"></i>Today's Energy Breakdown</h5></div>
          <div class="card-body"><div class="chart-wrap" style="height:240px;"><canvas id="breakdownChart"></canvas></div></div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card-custom">
          <div class="card-header-custom">
            <h5><i class="fas fa-bell text-blue me-2"></i>Recent Alerts</h5>
            <span class="badge-count badge-amber" id="alertCountBadge">3</span>
          </div>
          <div class="card-body" id="dashAlertsContainer" style="max-height:240px;overflow-y:auto;"></div>
        </div>
      </div>
    </div>

    <!-- Saving + Cost -->
    <div class="row g-3 mb-4">
      <div class="col-lg-7">
        <div class="saving-card">
          <h6><i class="fas fa-leaf" style="margin-right:6px;"></i>Energy Saving Recommendations</h6>
          <div class="saving-amount" id="savingAmount">&#8377;350</div>
          <ul>
            <li><i class="fas fa-check-circle"></i>Turn off unused appliances to reduce standby power consumption.</li>
            <li><i class="fas fa-check-circle"></i>Reduce high-power appliance usage during peak hours (6-10 PM).</li>
            <li><i class="fas fa-check-circle"></i>Check for abnormal energy consumption patterns regularly.</li>
            <li><i class="fas fa-check-circle"></i>Use energy-efficient appliances and optimize running schedules.</li>
            <li><i class="fas fa-check-circle"></i>Monitor and maintain power factor for efficient energy usage.</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card-custom" style="height:100%;">
          <div class="card-header-custom"><h5><i class="fas fa-calculator text-blue me-2"></i>Cost Summary</h5></div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center py-3 border-bottom" style="border-color:var(--card-border)!important;">
              <span style="font-size:13px;color:var(--gray-500);">Today's Cost</span>
              <span class="fw-800" style="font-size:18px;color:var(--white);" id="costToday">&#8377;9.50</span>
            </div>
            <div class="d-flex justify-content-between align-items-center py-3 border-bottom" style="border-color:var(--card-border)!important;">
              <span style="font-size:13px;color:var(--gray-500);">Weekly Cost</span>
              <span class="fw-800" style="font-size:18px;color:var(--white);" id="costWeekly">&#8377;62.30</span>
            </div>
            <div class="d-flex justify-content-between align-items-center py-3 border-bottom" style="border-color:var(--card-border)!important;">
              <span style="font-size:13px;color:var(--gray-500);">Monthly Estimated</span>
              <span class="fw-800" style="font-size:18px;color:var(--white);" id="costMonthly">&#8377;285.00</span>
            </div>
            <div class="d-flex justify-content-between align-items-center py-3">
              <span style="font-size:13px;color:var(--gray-500);">Tariff Rate</span>
              <span class="fw-800" style="font-size:18px;color:var(--blue-400);" id="tariffDisplay">&#8377;8.00/kWh</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== LIVE MONITORING ===== -->
  <section class="page-section" id="page-live-monitoring">
    <h4 class="section-title"><i class="fas fa-wave-square"></i>Live Monitoring</h4>
    <div class="row g-3 mb-4">
      <div class="col-lg-8">
        <div class="card-custom">
          <div class="card-header-custom"><h5>Real-Time Power Consumption</h5><span class="badge-count badge-blue">STREAMING</span></div>
          <div class="card-body">
            <div class="chart-wrap" style="height:350px;"><canvas id="liveMonitorChart"></canvas></div>
            <div class="last-updated-bar"><span class="pulse"></span> Auto-refreshing every 5 seconds</div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card-custom mb-3">
          <div class="card-body text-center">
            <div style="font-size:11px;font-weight:700;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;">Current Voltage</div>
            <div style="font-family:var(--font-display);font-size:42px;font-weight:800;color:var(--blue-400);margin:8px 0;" id="liveVolt">230.5</div>
            <div style="font-size:13px;color:var(--gray-500);">Volts (V)</div>
          </div>
        </div>
        <div class="card-custom mb-3">
          <div class="card-body text-center">
            <div style="font-size:11px;font-weight:700;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;">Current Draw</div>
            <div style="font-family:var(--font-display);font-size:42px;font-weight:800;color:var(--emerald-400);margin:8px 0;" id="liveAmp">0.42</div>
            <div style="font-size:13px;color:var(--gray-500);">Amperes (A)</div>
          </div>
        </div>
        <div class="card-custom">
          <div class="card-body text-center">
            <div style="font-size:11px;font-weight:700;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;">Power Draw</div>
            <div style="font-family:var(--font-display);font-size:42px;font-weight:800;color:var(--amber-400);margin:8px 0;" id="liveWatt">96.8</div>
            <div style="font-size:13px;color:var(--gray-500);">Watts (W)</div>
          </div>
        </div>
      </div>
    </div>
    <div class="card-custom">
      <div class="card-header-custom"><h5>Live Data Feed</h5></div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table-custom" id="liveFeedTable">
            <thead><tr><th>Time</th><th>Voltage</th><th>Current</th><th>Power</th><th>Energy</th><th>Status</th></tr></thead>
            <tbody id="liveFeedBody"></tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== ENERGY ANALYTICS ===== -->
  <section class="page-section" id="page-energy-analytics">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
      <h4 class="section-title mb-0"><i class="fas fa-chart-bar"></i>Energy Analytics</h4>
      <div class="filter-group">
        <button class="filter-btn active" data-range="today">Today</button>
        <button class="filter-btn" data-range="yesterday">Yesterday</button>
        <button class="filter-btn" data-range="7days">7 Days</button>
        <button class="filter-btn" data-range="30days">30 Days</button>
      </div>
    </div>
    <div class="row g-3 mb-4">
      <div class="col-lg-6">
        <div class="card-custom"><div class="card-header-custom"><h5>Hourly Energy Consumption</h5></div><div class="card-body"><div class="chart-wrap" style="height:260px;"><canvas id="hourlyChart"></canvas></div></div></div>
      </div>
      <div class="col-lg-6">
        <div class="card-custom"><div class="card-header-custom"><h5>Daily Energy Consumption</h5></div><div class="card-body"><div class="chart-wrap" style="height:260px;"><canvas id="dailyChart"></canvas></div></div></div>
      </div>
    </div>
    <div class="row g-3">
      <div class="col-lg-6">
        <div class="card-custom"><div class="card-header-custom"><h5>Weekly Energy Consumption</h5></div><div class="card-body"><div class="chart-wrap" style="height:260px;"><canvas id="weeklyChart"></canvas></div></div></div>
      </div>
      <div class="col-lg-6">
        <div class="card-custom"><div class="card-header-custom"><h5>Monthly Energy Consumption</h5></div><div class="card-body"><div class="chart-wrap" style="height:260px;"><canvas id="monthlyChart"></canvas></div></div></div>
      </div>
    </div>
  </section>

  <!-- ===== HISTORICAL DATA ===== -->
  <section class="page-section" id="page-historical-data">
    <h4 class="section-title"><i class="fas fa-database"></i>Historical Data</h4>
    <div class="card-custom">
      <div class="card-header-custom flex-wrap gap-2">
        <div class="search-box" style="min-width:220px;">
          <i class="fas fa-search"></i>
          <input type="text" class="form-control-custom" placeholder="Search records..." id="historySearch">
        </div>
        <div class="d-flex gap-2 align-items-center flex-wrap">
          <input type="date" class="form-control-custom" style="width:auto;" id="historyDateFrom">
          <span style="font-size:13px;color:var(--gray-500);">to</span>
          <input type="date" class="form-control-custom" style="width:auto;" id="historyDateTo">
          <button class="btn-blue btn-sm" id="historyFilterBtn"><i class="fas fa-filter"></i> Filter</button>
          <button class="btn-outline-blue btn-sm" id="historyExportBtn"><i class="fas fa-download"></i> Export CSV</button>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table-custom">
            <thead><tr><th>Date</th><th>Time</th><th>Voltage (V)</th><th>Current (A)</th><th>Power (W)</th><th>Energy (kWh)</th><th>Cost (&#8377;)</th><th>Status</th></tr></thead>
            <tbody id="historyBody"></tbody>
          </table>
        </div>
        <div class="d-flex justify-content-between align-items-center px-3 py-3" style="border-top:1px solid var(--card-border);">
          <span style="font-size:12px;color:var(--gray-500);" id="historyInfo">Showing 1-20 of 150 records</span>
          <div class="pagination-custom" id="historyPagination"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== AI PREDICTION ===== -->
  <section class="page-section" id="page-ai-prediction">
    <h4 class="section-title"><i class="fas fa-robot"></i>AI Energy Intelligence</h4>
    <div class="row g-3 mb-4">
      <div class="col-lg-7">
        <div class="ai-card">
          <div class="card-body" style="padding:24px;">
            <div class="ai-header">
              <div class="ai-icon"><i class="fas fa-brain"></i></div>
              <div class="ai-title">AI Energy Predictions</div>
            </div>
            <div class="ai-prediction-item"><div class="pred-label">Tomorrow's Expected Consumption</div><div class="pred-value blue" id="aiTomorrow">2.85 kWh</div></div>
            <div class="ai-prediction-item"><div class="pred-label">Expected Monthly Consumption</div><div class="pred-value purple" id="aiMonthly">85.4 kWh</div></div>
            <div class="ai-prediction-item"><div class="pred-label">Estimated Monthly Bill</div><div class="pred-value amber" id="aiBill">&#8377;683.20</div></div>
            <div class="ai-prediction-item">
              <div class="pred-label">Energy Usage Trend</div>
              <div class="pred-value" id="aiTrend" style="display:flex;align-items:center;gap:10px;">Increasing<span class="ai-trend-badge up"><i class="fas fa-arrow-up"></i> +12.3%</span></div>
            </div>
            <div class="ai-recommendation" id="aiRecommendation"><i class="fas fa-lightbulb"></i>Reduce high-power appliance usage during peak hours (6-10 PM) to save approximately &#8377;85 this month.</div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card-custom" style="height:100%;">
          <div class="card-header-custom"><h5><i class="fas fa-chart-line text-blue me-2"></i>Prediction Chart</h5></div>
          <div class="card-body"><div class="chart-wrap" style="height:300px;"><canvas id="aiPredictionChart"></canvas></div></div>
        </div>
      </div>
    </div>
    <div class="row g-3">
      <div class="col-lg-6">
        <div class="card-custom">
          <div class="card-header-custom"><h5><i class="fas fa-shield-alt text-blue me-2"></i>Abnormal Usage Detection</h5></div>
          <div class="card-body" id="abnormalContainer"></div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card-custom">
          <div class="card-header-custom"><h5><i class="fas fa-bullseye text-blue me-2"></i>Peak Usage Analysis</h5></div>
          <div class="card-body"><div class="chart-wrap" style="height:220px;"><canvas id="peakUsageChart"></canvas></div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== ALERTS ===== -->
  <section class="page-section" id="page-alerts">
    <h4 class="section-title"><i class="fas fa-bell"></i>Alerts & Notifications</h4>
    <div class="row g-3 mb-4">
      <div class="col-md-4"><div class="card-custom text-center"><div class="card-body py-4"><div style="font-size:32px;font-weight:800;color:var(--red-400);font-family:var(--font-display);" id="criticalCount">2</div><div style="font-size:12px;font-weight:600;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;">Critical Alerts</div></div></div></div>
      <div class="col-md-4"><div class="card-custom text-center"><div class="card-body py-4"><div style="font-size:32px;font-weight:800;color:var(--amber-400);font-family:var(--font-display);" id="warningCount">5</div><div style="font-size:12px;font-weight:600;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;">Warnings</div></div></div></div>
      <div class="col-md-4"><div class="card-custom text-center"><div class="card-body py-4"><div style="font-size:32px;font-weight:800;color:var(--emerald-400);font-family:var(--font-display);" id="normalCount">1</div><div style="font-size:12px;font-weight:600;color:var(--gray-500);text-transform:uppercase;letter-spacing:.5px;">System Normal</div></div></div></div>
    </div>
    <div class="card-custom">
      <div class="card-header-custom"><h5>Alert History</h5></div>
      <div class="card-body" id="alertHistoryContainer" style="max-height:500px;overflow-y:auto;"></div>
    </div>
  </section>

  <!-- ===== APPLIANCE CONTROL ===== -->
  <section class="page-section" id="page-appliance-control">
    <h4 class="section-title"><i class="fas fa-sliders-h"></i>Appliance Control</h4>
    <div class="row g-3" id="applianceGrid"></div>
  </section>

  <!-- ===== REPORTS ===== -->
  <section class="page-section" id="page-reports">
    <h4 class="section-title"><i class="fas fa-file-alt"></i>Reports</h4>
    <div class="row g-3 mb-4">
      <div class="col-lg-3 col-md-6"><div class="report-card" id="reportDaily"><div class="report-icon"><i class="fas fa-calendar-day"></i></div><h6>Daily Report</h6><p>Generate today's complete energy report</p></div></div>
      <div class="col-lg-3 col-md-6"><div class="report-card" id="reportWeekly"><div class="report-icon"><i class="fas fa-calendar-week"></i></div><h6>Weekly Report</h6><p>7-day energy consumption summary</p></div></div>
      <div class="col-lg-3 col-md-6"><div class="report-card" id="reportMonthly"><div class="report-icon"><i class="fas fa-calendar-alt"></i></div><h6>Monthly Report</h6><p>Monthly analytics and cost breakdown</p></div></div>
      <div class="col-lg-3 col-md-6"><div class="report-card" id="reportExport"><div class="report-icon"><i class="fas fa-file-csv"></i></div><h6>Export CSV</h6><p>Download raw data in CSV format</p></div></div>
    </div>
    <div class="card-custom">
      <div class="card-header-custom"><h5>Report Preview</h5><button class="btn-blue btn-sm" id="printReportBtn"><i class="fas fa-print"></i> Print</button></div>
      <div class="card-body" id="reportPreview">
        <div class="text-center py-5"><i class="fas fa-file-alt" style="font-size:48px;color:var(--gray-700);margin-bottom:16px;display:block;"></i><p style="color:var(--gray-500);">Select a report type above to generate a preview</p></div>
      </div>
    </div>
  </section>

  <!-- ===== SETTINGS ===== -->
  <section class="page-section" id="page-settings">
    <h4 class="section-title"><i class="fas fa-cog"></i>Settings</h4>
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="settings-group">
          <h6><i class="fas fa-indian-rupee-sign"></i>Electricity Tariff</h6>
          <div class="mb-3"><label style="font-size:13px;font-weight:600;color:var(--gray-400);margin-bottom:6px;display:block;">Tariff Rate (&#8377; per kWh)</label><input type="number" class="form-control-custom" id="settingTariff" value="8" step="0.5" min="0"></div>
          <button class="btn-blue btn-sm" id="saveTariffBtn"><i class="fas fa-save"></i> Save Tariff</button>
        </div>
        <div class="settings-group">
          <h6><i class="fas fa-exclamation-triangle"></i>Warning Limits</h6>
          <div class="mb-3"><label style="font-size:13px;font-weight:600;color:var(--gray-400);margin-bottom:6px;display:block;">Power Warning Limit (W)</label><input type="number" class="form-control-custom" id="settingPowerLimit" value="1000" step="50" min="0"></div>
          <div class="mb-3"><label style="font-size:13px;font-weight:600;color:var(--gray-400);margin-bottom:6px;display:block;">Current Warning Limit (A)</label><input type="number" class="form-control-custom" id="settingCurrentLimit" value="5" step="0.5" min="0"></div>
          <div class="mb-3"><label style="font-size:13px;font-weight:600;color:var(--gray-400);margin-bottom:6px;display:block;">Energy Warning Limit (kWh/day)</label><input type="number" class="form-control-custom" id="settingEnergyLimit" value="10" step="1" min="0"></div>
          <button class="btn-blue btn-sm" id="saveLimitsBtn"><i class="fas fa-save"></i> Save Limits</button>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="settings-group">
          <h6><i class="fas fa-cloud"></i>Carbon Footprint</h6>
          <div class="mb-3"><label style="font-size:13px;font-weight:600;color:var(--gray-400);margin-bottom:6px;display:block;">CO₂ Emission Factor (kg CO₂ per kWh)</label><input type="number" class="form-control-custom" id="settingCO2" value="0.76" step="0.01" min="0"></div>
          <button class="btn-blue btn-sm" id="saveCO2Btn"><i class="fas fa-save"></i> Save Factor</button>
        </div>
        <div class="settings-group">
          <h6><i class="fas fa-microchip"></i>ESP32 Device Configuration</h6>
          <div class="mb-3"><label style="font-size:13px;font-weight:600;color:var(--gray-400);margin-bottom:6px;display:block;">Device ID</label><input type="text" class="form-control-custom" id="settingDeviceId" value="ESP32_01"></div>
          <div class="mb-3"><label style="font-size:13px;font-weight:600;color:var(--gray-400);margin-bottom:6px;display:block;">Heartbeat Timeout (seconds)</label><input type="number" class="form-control-custom" id="settingHeartbeat" value="30" min="10" step="5"></div>
          <button class="btn-blue btn-sm" id="saveDeviceBtn"><i class="fas fa-save"></i> Save Device Config</button>
        </div>
      </div>
    </div>
  </section>

</main>

<footer class="main-footer">Smart Energy Monitoring & Intelligent Energy Management System &copy; 2025</footer>

<script>
const CONFIG={
    API_BASE:''
};
const STATE={connected:true,lastSeen:Date.now(),lastData:null,liveData:[],liveLabels:[],liveFeedRows:[],currentPage:'dashboard',historyPage:1,historyData:[],appliances:[{id:1,name:'Light',icon:'fa-lightbulb',on:true,power:60,energy:.45,relay:1},{id:2,name:'Fan',icon:'fa-fan',on:false,power:0,energy:0,relay:2},{id:3,name:'AC',icon:'fa-snowflake',on:false,power:0,energy:0,relay:3},{id:4,name:'TV',icon:'fa-tv',on:true,power:120,energy:.82,relay:4},{id:5,name:'Computer',icon:'fa-desktop',on:true,power:200,energy:1.35,relay:5},{id:6,name:'Water Heater',icon:'fa-hot-tub-person',on:false,power:0,energy:0,relay:6}],alerts:[]};

function generateSampleReading(){const v=220+Math.random()*20,i=.3+Math.random()*.4,p=v*i,e=parseFloat((STATE.lastData?STATE.lastData.energy+(p/1000)*(CONFIG.UPDATE_INTERVAL/36e5):1.25+Math.random()*.5).toFixed(4));return{voltage:parseFloat(v.toFixed(1)),current:parseFloat(i.toFixed(2)),power:parseFloat(p.toFixed(1)),energy:e,timestamp:new Date().toISOString().replace('T',' ').substring(0,19)}}
function generateHourlyData(){const l=[],v=[];for(let h=0;h<24;h++){l.push(h.toString().padStart(2,'0')+':00');v.push(parseFloat((.5+Math.random()*2.5).toFixed(2)))}return{labels:l,values:v}}
function generateDailyData(d){const l=[],v=[],n=new Date();for(let i=d-1;i>=0;i--){const dt=new Date(n-i*864e5);l.push(dt.toLocaleDateString('en-IN',{day:'numeric',month:'short'}));v.push(parseFloat((5+Math.random()*15).toFixed(2)))}return{labels:l,values:v}}
function generateWeeklyData(){const l=['Week 1','Week 2','Week 3','Week 4'];return{labels:l,values:l.map(()=>parseFloat((30+Math.random()*40).toFixed(1)))}}
function generateMonthlyData(){const l=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];return{labels:l,values:l.map(()=>parseFloat((80+Math.random()*60).toFixed(1)))}}

async function apiFetch(e){try{const r=await fetch(CONFIG.API_BASE+e,{headers:{'Accept':'application/json'}});if(!r.ok)throw new Error(r.status);return await r.json()}catch(x){return null}}
async function apiPost(e,b){try{const r=await fetch(CONFIG.API_BASE+e,{method:'POST',headers:{'Content-Type':'application/json','Accept':'application/json'},body:JSON.stringify(b)});if(!r.ok)throw new Error(r.status);return await r.json()}catch(x){return null}}

function showToast(m,t='success'){const c=document.getElementById('toastContainer'),el=document.createElement('div');el.className='toast-msg '+t;const i={success:'fa-check-circle',error:'fa-times-circle',warning:'fa-exclamation-triangle'};el.innerHTML=`<i class="fas ${i[t]||i.success}"></i> ${m}`;c.appendChild(el);setTimeout(()=>{el.style.opacity='0';el.style.transform='translateX(40px)';el.style.transition='all .3s'},3e3);setTimeout(()=>el.remove(),3400)}

function initNavigation(){document.querySelectorAll('.sidebar-nav .nav-link').forEach(l=>{l.addEventListener('click',e=>{e.preventDefault();const p=l.dataset.page;if(!p)return;document.querySelectorAll('.sidebar-nav .nav-link').forEach(x=>x.classList.remove('active'));l.classList.add('active');document.querySelectorAll('.page-section').forEach(s=>s.classList.remove('active'));const t=document.getElementById('page-'+p);if(t)t.classList.add('active');STATE.currentPage=p;document.getElementById('sidebar').classList.remove('open');document.getElementById('sidebarOverlay').classList.remove('show')})});document.getElementById('hamburgerBtn').addEventListener('click',()=>{document.getElementById('sidebar').classList.toggle('open');document.getElementById('sidebarOverlay').classList.toggle('show')});document.getElementById('sidebarOverlay').addEventListener('click',()=>{document.getElementById('sidebar').classList.remove('open');document.getElementById('sidebarOverlay').classList.remove('show')})}

const charts={};
const CD={responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false},tooltip:{backgroundColor:'rgba(10,14,26,.95)',titleColor:'#fff',bodyColor:'#cbd5e1',titleFont:{family:"'Plus Jakarta Sans'",size:12,weight:'600'},bodyFont:{family:"'Plus Jakarta Sans'",size:12},padding:10,cornerRadius:8,displayColors:false,borderColor:'rgba(59,130,246,.2)',borderWidth:1}},scales:{x:{grid:{color:'rgba(51,65,85,.2)',drawBorder:false},ticks:{font:{family:"'Plus Jakarta Sans'",size:11},color:'#64748b',maxTicksLimit:12}},y:{grid:{color:'rgba(51,65,85,.2)',drawBorder:false},ticks:{font:{family:"'Plus Jakarta Sans'",size:11},color:'#64748b'},beginAtZero:true}}};

function initCharts(){
  const ctx1=document.getElementById('livePowerChart').getContext('2d'),g1=ctx1.createLinearGradient(0,0,0,280);
  g1.addColorStop(0,'rgba(59,130,246,0.25)');g1.addColorStop(1,'rgba(59,130,246,0.01)');
  charts.livePower=new Chart(ctx1,{type:'line',data:{labels:[],datasets:[{label:'Power (W)',data:[],borderColor:'#3b82f6',backgroundColor:g1,borderWidth:2.5,fill:true,tension:.4,pointRadius:0,pointHoverRadius:5,pointHoverBackgroundColor:'#3b82f6',pointHoverBorderColor:'#fff',pointHoverBorderWidth:2}]},options:{...CD,scales:{...CD.scales,y:{...CD.scales.y,title:{display:true,text:'Power (W)',font:{size:11,weight:'600'},color:'#64748b'}},x:{...CD.scales.x,title:{display:true,text:'Time',font:{size:11,weight:'600'},color:'#64748b'}}},interaction:{mode:'index',intersect:false},animation:{duration:400}}});

  charts.breakdown=new Chart(document.getElementById('breakdownChart'),{type:'doughnut',data:{labels:['Lighting','Cooling','Electronics','Heating','Other'],datasets:[{data:[18,35,28,12,7],backgroundColor:['#3b82f6','#60a5fa','#f59e0b','#ef4444','#64748b'],borderWidth:0,hoverOffset:6}]},options:{responsive:true,maintainAspectRatio:false,cutout:'65%',plugins:{legend:{position:'right',labels:{font:{family:"'Plus Jakarta Sans'",size:12,weight:'500'},color:'#94a3b8',padding:12,usePointStyle:true,pointStyleWidth:10}},tooltip:CD.plugins.tooltip}}});

  const ctx2=document.getElementById('liveMonitorChart').getContext('2d'),g2=ctx2.createLinearGradient(0,0,0,350);
  g2.addColorStop(0,'rgba(59,130,246,0.2)');g2.addColorStop(1,'rgba(59,130,246,0.01)');
  charts.liveMonitor=new Chart(ctx2,{type:'line',data:{labels:[],datasets:[{label:'Power (W)',data:[],borderColor:'#3b82f6',backgroundColor:g2,borderWidth:2,fill:true,tension:.4,pointRadius:0}]},options:{...CD,scales:{...CD.scales,y:{...CD.scales.y,title:{display:true,text:'Watts',font:{size:11},color:'#64748b'}}},animation:{duration:300}}});

  const h=generateHourlyData();
  charts.hourly=new Chart(document.getElementById('hourlyChart'),{type:'bar',data:{labels:h.labels,datasets:[{label:'kWh',data:h.values,backgroundColor:'rgba(59,130,246,0.5)',hoverBackgroundColor:'rgba(59,130,246,0.8)',borderRadius:4,borderSkipped:false}]},options:{...CD,scales:{...CD.scales,y:{...CD.scales.y,title:{display:true,text:'kWh',font:{size:11},color:'#64748b'}}}}});

  const d=generateDailyData(7),ctx3=document.getElementById('dailyChart').getContext('2d'),g3=ctx3.createLinearGradient(0,0,0,260);
  g3.addColorStop(0,'rgba(59,130,246,0.2)');g3.addColorStop(1,'rgba(59,130,246,0.01)');
  charts.daily=new Chart(ctx3,{type:'line',data:{labels:d.labels,datasets:[{label:'kWh',data:d.values,borderColor:'#3b82f6',backgroundColor:g3,borderWidth:2.5,fill:true,tension:.4,pointRadius:4,pointBackgroundColor:'#3b82f6',pointBorderColor:'#0f172a',pointBorderWidth:2}]},options:{...CD,scales:{...CD.scales,y:{...CD.scales.y,title:{display:true,text:'kWh',font:{size:11},color:'#64748b'}}}}});

  const w=generateWeeklyData();
  charts.weekly=new Chart(document.getElementById('weeklyChart'),{type:'bar',data:{labels:w.labels,datasets:[{label:'kWh',data:w.values,backgroundColor:['rgba(59,130,246,0.6)','rgba(59,130,246,0.45)','rgba(59,130,246,0.35)','rgba(59,130,246,0.2)'],borderRadius:6,borderSkipped:false}]},options:{...CD,scales:{...CD.scales,y:{...CD.scales.y,title:{display:true,text:'kWh',font:{size:11},color:'#64748b'}}}}});

  const m=generateMonthlyData();
  charts.monthly=new Chart(document.getElementById('monthlyChart'),{type:'bar',data:{labels:m.labels,datasets:[{label:'kWh',data:m.values,backgroundColor:'rgba(59,130,246,0.4)',hoverBackgroundColor:'rgba(59,130,246,0.7)',borderRadius:4,borderSkipped:false}]},options:{...CD,scales:{...CD.scales,y:{...CD.scales.y,title:{display:true,text:'kWh',font:{size:11},color:'#64748b'}}}}});

  const aiL=[],aiA=[],aiP=[],now=new Date();
  for(let i=13;i>=0;i--){const dt=new Date(now-i*864e5);aiL.push(dt.toLocaleDateString('en-IN',{day:'numeric',month:'short'}));if(i>=2){aiA.push(parseFloat((5+Math.random()*10).toFixed(1)));aiP.push(null)}else if(i===1){aiA.push(parseFloat((5+Math.random()*10).toFixed(1)));aiP.push(parseFloat((5+Math.random()*10).toFixed(1)))}else{aiA.push(null);aiP.push(parseFloat((6+Math.random()*9).toFixed(1)))}}
  const ctx4=document.getElementById('aiPredictionChart').getContext('2d'),g4a=ctx4.createLinearGradient(0,0,0,300),g4b=ctx4.createLinearGradient(0,0,0,300);
  g4a.addColorStop(0,'rgba(59,130,246,0.15)');g4a.addColorStop(1,'rgba(59,130,246,0.01)');
  g4b.addColorStop(0,'rgba(167,139,250,0.15)');g4b.addColorStop(1,'rgba(167,139,250,0.01)');
  charts.aiPrediction=new Chart(ctx4,{type:'line',data:{labels:aiL,datasets:[{label:'Actual',data:aiA,borderColor:'#3b82f6',backgroundColor:g4a,borderWidth:2.5,fill:true,tension:.4,pointRadius:3,pointBackgroundColor:'#3b82f6'},{label:'Predicted',data:aiP,borderColor:'#a78bfa',backgroundColor:g4b,borderWidth:2.5,borderDash:[6,4],fill:true,tension:.4,pointRadius:3,pointBackgroundColor:'#a78bfa'}]},options:{...CD,plugins:{...CD.plugins,legend:{display:true,labels:{font:{family:"'Plus Jakarta Sans'",size:12},color:'#94a3b8',usePointStyle:true,pointStyleWidth:10,padding:16}}},scales:{...CD.scales,y:{...CD.scales.y,title:{display:true,text:'kWh',font:{size:11},color:'#64748b'}}}}});

  charts.peakUsage=new Chart(document.getElementById('peakUsageChart'),{type:'polarArea',data:{labels:['Morning','Afternoon','Evening','Night'],datasets:[{data:[8,12,22,5],backgroundColor:['rgba(59,130,246,0.4)','rgba(96,165,250,0.4)','rgba(245,158,11,0.4)','rgba(100,116,139,0.3)'],borderWidth:0}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{position:'right',labels:{font:{family:"'Plus Jakarta Sans'",size:12},color:'#94a3b8',padding:10,usePointStyle:true}},tooltip:CD.plugins.tooltip},scales:{r:{grid:{color:'rgba(51,65,85,.2)'},ticks:{display:false}}}}});
}

function updateStatCards(d){const c=(d.energy*CONFIG.tariff).toFixed(2),co=(d.energy*CONFIG.co2Factor).toFixed(2);document.getElementById('valVoltage').textContent=d.voltage.toFixed(1);document.getElementById('valCurrent').textContent=d.current.toFixed(2);document.getElementById('valPower').textContent=d.power.toFixed(1);document.getElementById('valEnergy').textContent=d.energy.toFixed(2);document.getElementById('valCost').textContent='\u20B9'+c;document.getElementById('valCarbon').textContent=co;document.getElementById('costToday').textContent='\u20B9'+c;document.getElementById('costWeekly').textContent='\u20B9'+(d.energy*CONFIG.tariff*7).toFixed(2);document.getElementById('costMonthly').textContent='\u20B9'+(d.energy*CONFIG.tariff*30).toFixed(2);document.getElementById('tariffDisplay').textContent='\u20B9'+CONFIG.tariff.toFixed(2)+'/kWh';[{id:'changeVoltage',v:(Math.random()*4-2).toFixed(1)},{id:'changeCurrent',v:(Math.random()*6-3).toFixed(1)},{id:'changePower',v:(Math.random()*8-4).toFixed(1)},{id:'changeEnergy',v:(Math.random()*4-2).toFixed(1)},{id:'changeCost',v:(Math.random()*6-3).toFixed(1)},{id:'changeCarbon',v:(Math.random()*4-2).toFixed(1)}].forEach(c=>{const el=document.getElementById(c.id),v=parseFloat(c.v);el.className='stat-change '+(v>=0?'up':'down');el.innerHTML=`<i class="fas fa-arrow-${v>=0?'up':'down'}"></i> ${Math.abs(v)}%`})}

function updateESPStatus(conn,ls){STATE.connected=conn;STATE.lastSeen=ls;const b=document.getElementById('headerEspBadge'),dot=document.getElementById('headerDot'),txt=document.getElementById('headerEspText');if(conn){b.className='esp-status-badge connected';dot.className='status-dot online';txt.textContent='ESP32 CONNECTED'}else{b.className='esp-status-badge disconnected';dot.className='status-dot offline';txt.textContent='ESP32 DISCONNECTED'}const s=Math.floor((Date.now()-ls)/1e3);document.getElementById('headerLastSeen').textContent=`Last Seen: ${s<60?s+' seconds ago':Math.floor(s/60)+' minutes ago'}`;const db=document.getElementById('deviceBadge');if(conn){db.className='device-badge online';db.textContent='CONNECTED';document.getElementById('deviceWifi').textContent='Connected';document.getElementById('deviceHeartbeat').textContent='Active'}else{db.className='device-badge offline';db.textContent='DISCONNECTED';document.getElementById('deviceWifi').textContent='Disconnected';document.getElementById('deviceHeartbeat').textContent='Inactive'}document.getElementById('deviceLastSeen').textContent=new Date(ls).toLocaleTimeString('en-IN');document.getElementById('deviceUptime').textContent=conn?formatUptime(Date.now()-ls+36e5*5):'--'}
function formatUptime(ms){const h=Math.floor(ms/36e5),m=Math.floor((ms%36e5)/6e4);return h+'h '+m+'m'}

function updateEfficiencyScore(d){const r=Math.min(d.power/CONFIG.powerLimit,1);let s=Math.round(100-(r*60)+(Math.random()*10-5));s=Math.max(40,Math.min(99,s));const c=2*Math.PI*50,o=c*(1-s/100),ring=document.getElementById('efficiencyRing');ring.style.strokeDashoffset=o;let col,lab;if(s>=80){col='#3b82f6';lab='EXCELLENT'}else if(s>=60){col='#f59e0b';lab='GOOD'}else{col='#ef4444';lab='POOR'}ring.style.stroke=col;document.getElementById('efficiencyNum').textContent=s;document.getElementById('efficiencyLabel').textContent=lab}

function updateLiveChart(d){const t=new Date().toLocaleTimeString('en-IN',{hour:'2-digit',minute:'2-digit',second:'2-digit'});STATE.liveLabels.push(t);STATE.liveData.push(d.power);if(STATE.liveLabels.length>CONFIG.MAX_LIVE_POINTS){STATE.liveLabels.shift();STATE.liveData.shift()}charts.livePower.data.labels=[...STATE.liveLabels];charts.livePower.data.datasets[0].data=[...STATE.liveData];charts.livePower.update('none');if(charts.liveMonitor){charts.liveMonitor.data.labels=[...STATE.liveLabels];charts.liveMonitor.data.datasets[0].data=[...STATE.liveData];charts.liveMonitor.update('none')}}

function updateLiveFeed(d){STATE.liveFeedRows.unshift(d);if(STATE.liveFeedRows.length>15)STATE.liveFeedRows.pop();document.getElementById('liveFeedBody').innerHTML=STATE.liveFeedRows.map(r=>{const sc=r.power>CONFIG.powerLimit?'badge-red':r.power>CONFIG.powerLimit*.7?'badge-amber':'badge-green',st=r.power>CONFIG.powerLimit?'Critical':r.power>CONFIG.powerLimit*.7?'Warning':'Normal';return`<tr><td>${r.timestamp?r.timestamp.split(' ')[1]:new Date().toLocaleTimeString()}</td><td>${r.voltage.toFixed(1)}</td><td>${r.current.toFixed(2)}</td><td>${r.power.toFixed(1)}</td><td>${r.energy.toFixed(4)}</td><td><span class="${sc}">${st}</span></td></tr>`}).join('');document.getElementById('liveVolt').textContent=d.voltage.toFixed(1);document.getElementById('liveAmp').textContent=d.current.toFixed(2);document.getElementById('liveWatt').textContent=d.power.toFixed(1)}

function generateAlerts(d){const a=[],n=new Date();if(d.power>CONFIG.powerLimit)a.push({type:'critical',icon:'fa-exclamation-circle',text:`High Power Consumption — Power exceeded ${CONFIG.powerLimit} W threshold. Current: ${d.power.toFixed(1)} W`,time:n.toLocaleTimeString()});else if(d.power>CONFIG.powerLimit*.7)a.push({type:'warning',icon:'fa-exclamation-triangle',text:`Power approaching warning limit. Current: ${d.power.toFixed(1)} W / ${CONFIG.powerLimit} W`,time:n.toLocaleTimeString()});if(d.current>CONFIG.currentLimit)a.push({type:'critical',icon:'fa-bolt',text:`High Current Detected — Current exceeded safe limit of ${CONFIG.currentLimit} A. Current: ${d.current.toFixed(2)} A`,time:n.toLocaleTimeString()});if(d.energy>CONFIG.energyLimit*.8)a.push({type:'warning',icon:'fa-chart-line',text:`Daily energy consumption approaching the ${CONFIG.energyLimit} kWh limit. Current: ${d.energy.toFixed(2)} kWh`,time:n.toLocaleTimeString()});if(d.voltage>245||d.voltage<200)a.push({type:'warning',icon:'fa-plug',text:`Abnormal Voltage Detected — ${d.voltage.toFixed(1)} V is outside safe range (200-245 V)`,time:n.toLocaleTimeString()});if(!a.length)a.push({type:'success',icon:'fa-check-circle',text:'System Normal — All parameters are within safe limits.',time:n.toLocaleTimeString()});const ha=[{type:'warning',icon:'fa-exclamation-triangle',text:'Power spike detected at 14:32 — reached 850 W temporarily',time:'14:32:15'},{type:'critical',icon:'fa-exclamation-circle',text:'Current exceeded 5A limit at 12:15 — measured 5.23 A',time:'12:15:42'},{type:'success',icon:'fa-check-circle',text:'System returned to normal parameters after brief spike',time:'12:20:00'},{type:'warning',icon:'fa-chart-line',text:'Energy consumption 15% higher than same time yesterday',time:'10:45:30'},{type:'success',icon:'fa-check-circle',text:'All systems operational. No anomalies detected.',time:'08:00:00'},{type:'warning',icon:'fa-plug',text:'Voltage fluctuation detected — dropped to 198V briefly',time:'Yesterday 22:10'},{type:'critical',icon:'fa-exclamation-circle',text:'ESP32 heartbeat missed — device was unreachable for 45 seconds',time:'Yesterday 18:30'},{type:'success',icon:'fa-check-circle',text:'ESP32 reconnected successfully',time:'Yesterday 18:31'}];STATE.alerts=[...a,...ha];renderAlerts()}

function renderAlerts(){document.getElementById('dashAlertsContainer').innerHTML=STATE.alerts.slice(0,4).map(a=>`<div class="alert-item ${a.type}"><div class="alert-icon"><i class="fas ${a.icon}"></i></div><div><div class="alert-text">${a.text}</div><div class="alert-time">${a.time}</div></div></div>`).join('');document.getElementById('alertHistoryContainer').innerHTML=STATE.alerts.map(a=>`<div class="alert-item ${a.type}"><div class="alert-icon"><i class="fas ${a.icon}"></i></div><div><div class="alert-text">${a.text}</div><div class="alert-time">${a.time}</div></div></div>`).join('');document.getElementById('criticalCount').textContent=STATE.alerts.filter(a=>a.type==='critical').length;document.getElementById('warningCount').textContent=STATE.alerts.filter(a=>a.type==='warning').length;document.getElementById('normalCount').textContent=STATE.alerts.filter(a=>a.type==='success').length;document.getElementById('alertCountBadge').textContent=STATE.alerts.filter(a=>a.type!=='success').length}

function renderAbnormalDetection(d){const c=[],ct=document.getElementById('abnormalContainer');if(d.power>CONFIG.powerLimit*.8)c.push({type:'critical',icon:'fa-exclamation-circle',text:`High Power Consumption: ${d.power.toFixed(1)} W exceeds 80% of the ${CONFIG.powerLimit} W threshold.`});if(d.current>CONFIG.currentLimit*.8)c.push({type:'warning',icon:'fa-bolt',text:`Elevated Current: ${d.current.toFixed(2)} A is approaching the ${CONFIG.currentLimit} A safety limit.`});if(d.voltage>245||d.voltage<200)c.push({type:'warning',icon:'fa-plug',text:`Voltage Anomaly: ${d.voltage.toFixed(1)} V is outside the normal 200-245 V range.`});if(!c.length)c.push({type:'success',icon:'fa-shield-alt',text:'All parameters are within normal operating ranges. No anomalies detected.'});ct.innerHTML=c.map(i=>`<div class="alert-item ${i.type}"><div class="alert-icon"><i class="fas ${i.icon}"></i></div><div class="alert-text">${i.text}</div></div>`).join('')}

function updateAIPredictions(d){const tk=parseFloat((d.energy*1.1+Math.random()*.5).toFixed(2)),mk=parseFloat((d.energy*30*.9+Math.random()*10).toFixed(1)),mb=parseFloat((mk*CONFIG.tariff).toFixed(2));document.getElementById('aiTomorrow').textContent=tk+' kWh';document.getElementById('aiMonthly').textContent=mk+' kWh';document.getElementById('aiBill').textContent='\u20B9'+mb.toFixed(2);const tv=(Math.random()*20-8).toFixed(1),up=parseFloat(tv)>=0;document.getElementById('aiTrend').innerHTML=`${up?'Increasing':'Decreasing'}<span class="ai-trend-badge ${up?'up':'down'}"><i class="fas fa-arrow-${up?'up':'down'}"></i> ${Math.abs(tv)}%</span>`;const recs=[`Reduce high-power appliance usage during peak hours (6-10 PM) to save approximately \u20B9${Math.round(mb*.12)} this month.`,`Your ${up?'increasing':'decreasing'} consumption trend suggests ${up?'reviewing appliance schedules':'current optimization is working well'}. Consider automated scheduling.`];document.getElementById('aiRecommendation').innerHTML=`<i class="fas fa-lightbulb"></i>${recs[Math.floor(Math.random()*recs.length)]}`}

function renderAppliances(){const g=document.getElementById('applianceGrid');g.innerHTML=STATE.appliances.map(a=>`<div class="col-lg-4 col-md-6"><div class="appliance-card ${a.on?'on':'off'}" id="app-card-${a.id}"><div class="app-header"><div class="app-name"><i class="fas ${a.icon}"></i>${a.name}</div><span class="app-status">${a.on?'ON':'OFF'}</span></div><div class="app-stats"><div class="app-stat">Power<span>${a.on?a.power+' W':'0 W'}</span></div><div class="app-stat">Energy<span>${a.energy.toFixed(2)} kWh</span></div><div class="app-stat">Relay<span>Relay ${a.relay} ${a.on?'ON':'OFF'}</span></div><div class="app-stat">Status<span style="color:${a.on?'var(--blue-400)':'var(--gray-600)'}">${a.on?'Active':'Inactive'}</span></div></div><div class="d-flex justify-content-between align-items-center"><span style="font-size:12px;color:var(--gray-500);">Toggle Power</span><label class="toggle-switch"><input type="checkbox" ${a.on?'checked':''} data-app-id="${a.id}"><span class="slider"></span></label></div></div></div>`).join('');g.querySelectorAll('.toggle-switch input').forEach(t=>{t.addEventListener('change',async e=>{const id=parseInt(e.target.dataset.appId),app=STATE.appliances.find(x=>x.id===id);if(!app)return;await apiPost('relay_control.php',{relay:app.relay,state:e.target.checked?1:0});app.on=e.target.checked;app.power=app.on?[60,75,1500,120,200,2000][app.id-1]:0;renderAppliances();showToast(`${app.name} turned ${app.on?'ON':'OFF'}`,app.on?'success':'warning')})})}

function renderHistoryTable(){const d=STATE.historyData,p=CONFIG.HISTORY_PER_PAGE,tot=d.length,tp=Math.ceil(tot/p)||1;if(STATE.historyPage>tp)STATE.historyPage=tp;const st=(STATE.historyPage-1)*p,pd=d.slice(st,st+p);document.getElementById('historyBody').innerHTML=pd.map(r=>{const sc=r.status==='Critical'?'badge-red':r.status==='Warning'?'badge-amber':'badge-green';return`<tr><td>${r.date}</td><td>${r.time}</td><td>${r.voltage}</td><td>${r.current}</td><td>${r.power}</td><td>${r.energy}</td><td>\u20B9${r.cost}</td><td><span class="${sc}">${r.status}</span></td></tr>`}).join('');document.getElementById('historyInfo').textContent=`Showing ${st+1}-${Math.min(st+p,tot)} of ${tot} records`;const pg=document.getElementById('historyPagination');let ph='';if(STATE.historyPage>1)ph+=`<button class="page-btn" data-page="${STATE.historyPage-1}"><i class="fas fa-chevron-left"></i></button>`;for(let i=1;i<=tp;i++){if(tp>7&&Math.abs(i-STATE.historyPage)>2&&i!==1&&i!==tp){if(i===2||i===tp-1)ph+=`<span style="padding:0 4px;color:var(--gray-600);">...</span>`;continue}ph+=`<button class="page-btn ${i===STATE.historyPage?'active':''}" data-page="${i}">${i}</button>`}if(STATE.historyPage<tp)ph+=`<button class="page-btn" data-page="${STATE.historyPage+1}"><i class="fas fa-chevron-right"></i></button>`;pg.innerHTML=ph;pg.querySelectorAll('.page-btn').forEach(b=>{b.addEventListener('click',()=>{STATE.historyPage=parseInt(b.dataset.page);renderHistoryTable()})})}

function initFilterButtons(){document.querySelectorAll('.filter-btn').forEach(b=>{b.addEventListener('click',()=>{document.querySelectorAll('.filter-btn').forEach(x=>x.classList.remove('active'));b.classList.add('active');const r=b.dataset.range;const h=generateHourlyData();charts.hourly.data.labels=h.labels;charts.hourly.data.datasets[0].data=h.values;charts.hourly.update();const dy=generateDailyData(r==='30days'?30:r==='7days'?7:1);charts.daily.data.labels=dy.labels;charts.daily.data.datasets[0].data=dy.values;charts.daily.update();showToast(`Showing ${b.textContent} data`,'success')})})}

function initReports(){document.getElementById('reportDaily').addEventListener('click',()=>generateReport('daily'));document.getElementById('reportWeekly').addEventListener('click',()=>generateReport('weekly'));document.getElementById('reportMonthly').addEventListener('click',()=>generateReport('monthly'));document.getElementById('reportExport').addEventListener('click',exportCSV);document.getElementById('printReportBtn').addEventListener('click',()=>window.print())}

function generateReport(type){const pr=document.getElementById('reportPreview'),d=STATE.lastData||{voltage:230,current:.42,power:96.8,energy:1.25},c=(d.energy*CONFIG.tariff).toFixed(2),co=(d.energy*CONFIG.co2Factor).toFixed(2),ps={daily:'Daily',weekly:'Weekly',monthly:'Monthly'},ml={daily:1,weekly:7,monthly:30};pr.innerHTML=`<div style="padding:20px;"><div class="text-center mb-4"><h5 style="font-family:var(--font-display);font-weight:800;color:var(--white);">${ps[type]} Energy Report</h5><p style="font-size:13px;color:var(--gray-500);">Generated: ${new Date().toLocaleString('en-IN')}</p></div><table class="table-custom" style="max-width:500px;margin:0 auto;"><tr><td style="font-weight:600;color:var(--gray-400);">Period</td><td>${ps[type]} Report</td></tr><tr><td style="font-weight:600;color:var(--gray-400);">Total Energy</td><td>${(d.energy*ml[type]).toFixed(2)} kWh</td></tr><tr><td style="font-weight:600;color:var(--gray-400);">Estimated Cost</td><td>\u20B9${(d.energy*CONFIG.tariff*ml[type]).toFixed(2)}</td></tr><tr><td style="font-weight:600;color:var(--gray-400);">CO₂ Emissions</td><td>${(d.energy*CONFIG.co2Factor*ml[type]).toFixed(2)} kg CO₂</td></tr><tr><td style="font-weight:600;color:var(--gray-400);">Avg. Voltage</td><td>${d.voltage.toFixed(1)} V</td></tr><tr><td style="font-weight:600;color:var(--gray-400);">Avg. Power</td><td>${d.power.toFixed(1)} W</td></tr><tr><td style="font-weight:600;color:var(--gray-400);">Tariff Rate</td><td>\u20B9${CONFIG.tariff}/kWh</td></tr><tr><td style="font-weight:600;color:var(--gray-400);">Device</td><td>${CONFIG.deviceId}</td></tr></table><div class="text-center mt-4"><button class="btn-blue" onclick="window.print()"><i class="fas fa-print"></i> Print Report</button></div></div>`;showToast(`${ps[type]} report generated`,'success')}

function exportCSV(){const d=STATE.historyData;if(!d.length){showToast('No data to export','warning');return}let csv='Date,Time,Voltage (V),Current (A),Power (W),Energy (kWh),Cost (INR),Status\n';d.forEach(r=>{csv+=`${r.date},${r.time},${r.voltage},${r.current},${r.power},${r.energy},${r.cost},${r.status}\n`});const b=new Blob([csv],{type:'text/csv'}),u=URL.createObjectURL(b),a=document.createElement('a');a.href=u;a.download=`energy_data_${new Date().toISOString().split('T')[0]}.csv`;a.click();URL.revokeObjectURL(u);showToast('CSV exported successfully','success')}

function initSettings(){document.getElementById('saveTariffBtn').addEventListener('click',()=>{const v=parseFloat(document.getElementById('settingTariff').value);if(isNaN(v)||v<0){showToast('Invalid tariff value','error');return}CONFIG.tariff=v;document.getElementById('tariffDisplay').textContent='\u20B9'+v.toFixed(2)+'/kWh';showToast('Tariff rate saved: \u20B9'+v.toFixed(2)+'/kWh','success');apiPost('save_settings.php',{key:'tariff',value:v})});document.getElementById('saveLimitsBtn').addEventListener('click',()=>{CONFIG.powerLimit=parseFloat(document.getElementById('settingPowerLimit').value)||1e3;CONFIG.currentLimit=parseFloat(document.getElementById('settingCurrentLimit').value)||5;CONFIG.energyLimit=parseFloat(document.getElementById('settingEnergyLimit').value)||10;showToast('Warning limits updated','success');apiPost('save_settings.php',{key:'limits',value:{power:CONFIG.powerLimit,current:CONFIG.currentLimit,energy:CONFIG.energyLimit}})});document.getElementById('saveCO2Btn').addEventListener('click',()=>{const v=parseFloat(document.getElementById('settingCO2').value);if(isNaN(v)||v<0){showToast('Invalid CO₂ factor','error');return}CONFIG.co2Factor=v;showToast('CO₂ emission factor saved: '+v+' kg/kWh','success');apiPost('save_settings.php',{key:'co2_factor',value:v})});document.getElementById('saveDeviceBtn').addEventListener('click',()=>{CONFIG.deviceId=document.getElementById('settingDeviceId').value||'ESP32_01';CONFIG.HEARTBEAT_TIMEOUT=(parseInt(document.getElementById('settingHeartbeat').value)||30)*1e3;document.getElementById('deviceId').textContent=CONFIG.deviceId;showToast('Device configuration saved','success');apiPost('save_settings.php',{key:'device',value:{device_id:CONFIG.deviceId,heartbeat:CONFIG.HEARTBEAT_TIMEOUT}})})}

function initHistoryControls(){document.getElementById('historyFilterBtn').addEventListener('click',()=>{const f=document.getElementById('historyDateFrom').value,t=document.getElementById('historyDateTo').value;let fl=[...STATE.historyData];if(f)fl=fl.filter(r=>r.date>=f);if(t)fl=fl.filter(r=>r.date<=t);STATE.historyData=fl;STATE.historyPage=1;renderHistoryTable();showToast(`Filtered: ${fl.length} records found`,'success')});document.getElementById('historySearch').addEventListener('input',e=>{const q=e.target.value.toLowerCase();document.querySelectorAll('#historyBody tr').forEach(r=>{r.style.display=r.textContent.toLowerCase().includes(q)?'':'none'})});document.getElementById('historyExportBtn').addEventListener('click',exportCSV)}

async function fetchAndUpdate(){let data=await apiFetch('get_latest_data.php');let status=await apiFetch('esp32_status.php');if(data){STATE.lastData=data;const conn=status?(Date.now()-new Date(status.last_seen).getTime()<CONFIG.HEARTBEAT_TIMEOUT):false;const ls=status?new Date(status.last_seen).getTime():Date.now();updateESPStatus(conn,ls)}else{data=generateSampleReading();STATE.lastData=data;updateESPStatus(STATE.connected,Date.now())}updateStatCards(data);updateLiveChart(data);updateLiveFeed(data);updateEfficiencyScore(data);generateAlerts(data);renderAbnormalDetection(data);updateAIPredictions(data);document.getElementById('lastUpdatedText').textContent='just now'}

let lastUpdateTime=Date.now();
function updateLastUpdatedTimer(){const s=Math.floor((Date.now()-lastUpdateTime)/1e3),el=document.getElementById('lastUpdatedText');if(el){if(s<5)el.textContent='just now';else if(s<60)el.textContent=s+' seconds ago';else el.textContent=Math.floor(s/60)+' minutes ago'}if(Date.now()-STATE.lastSeen>CONFIG.HEARTBEAT_TIMEOUT&&STATE.connected)updateESPStatus(false,STATE.lastSeen)}

function init(){initNavigation();initCharts();initFilterButtons();initReports();initSettings();initHistoryControls();STATE.historyData=generateHistoricalData();renderHistoryTable();renderAppliances();fetchAndUpdate().then(()=>{lastUpdateTime=Date.now()});setInterval(async()=>{await fetchAndUpdate();lastUpdateTime=Date.now()},CONFIG.UPDATE_INTERVAL);setInterval(updateLastUpdatedTimer,1e3)}
document.addEventListener('DOMContentLoaded',init);
</script>
</body>
</html>