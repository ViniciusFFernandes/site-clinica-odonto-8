<?php
// index.php — página única da Clínica (conteúdo vem de config/clinica.php)
$cfg = require __DIR__ . '/config/clinica.php';

function e($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function whats($cfg, $msg = null){
  $msg = $msg ?? $cfg['whatsapp_msg'];
  return 'https://wa.me/' . $cfg['whatsapp_numero'] . '?text=' . rawurlencode($msg);
}

/**
 * Ícones (Lucide + marcas) inline como SVG.
 * $class recebe utilitários Tailwind (ex: "size-5").
 */
function icon($name, $class = 'size-5'){
  static $map = [
    'sparkles' => '<path d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z"/><path d="M20 2v4"/><path d="M22 4h-4"/><circle cx="4" cy="20" r="2"/>',
    'smile' => '<circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" x2="9.01" y1="9" y2="9"/><line x1="15" x2="15.01" y1="9" y2="9"/>',
    'anchor' => '<path d="M12 6v16"/><path d="m19 13 2-1a9 9 0 0 1-18 0l2 1"/><path d="M9 11h6"/><circle cx="12" cy="4" r="2"/>',
    'align-horizontal-distribute-center' => '<rect width="6" height="14" x="4" y="5" rx="2"/><rect width="6" height="10" x="14" y="7" rx="2"/><path d="M17 22v-5"/><path d="M17 7V2"/><path d="M7 22v-3"/><path d="M7 5V2"/>',
    'layers' => '<path d="M12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83z"/><path d="M2 12a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 12"/><path d="M2 17a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 17"/>',
    'stethoscope' => '<path d="M11 2v2"/><path d="M5 2v2"/><path d="M5 3H4a2 2 0 0 0-2 2v4a6 6 0 0 0 12 0V5a2 2 0 0 0-2-2h-1"/><path d="M8 15a6 6 0 0 0 12 0v-3"/><circle cx="20" cy="10" r="2"/>',
    'scissors' => '<circle cx="6" cy="6" r="3"/><path d="M8.12 8.12 12 12"/><path d="M20 4 8.12 15.88"/><circle cx="6" cy="18" r="3"/><path d="M14.8 14.8 20 20"/>',
    'gem' => '<path d="M10.5 3 8 9l4 13 4-13-2.5-6"/><path d="M17 3a2 2 0 0 1 1.6.8l3 4a2 2 0 0 1 .013 2.382l-7.99 10.986a2 2 0 0 1-3.247 0l-7.99-10.986A2 2 0 0 1 2.4 7.8l2.998-3.997A2 2 0 0 1 7 3z"/><path d="M2 9h20"/>',
    'baby' => '<path d="M10 16c.5.3 1.2.5 2 .5s1.5-.2 2-.5"/><path d="M15 12h.01"/><path d="M19.38 6.813A9 9 0 0 1 20.8 10.2a2 2 0 0 1 0 3.6 9 9 0 0 1-17.6 0 2 2 0 0 1 0-3.6A9 9 0 0 1 12 3c2 0 3.5 1.1 3.5 2.5s-.9 2.5-2 2.5c-.8 0-1.5-.4-1.5-1"/><path d="M9 12h.01"/>',
    'star' => '<path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/>',
    'phone' => '<path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"/>',
    'message-circle' => '<path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719"/>',
    'map-pin' => '<path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/>',
    'clock' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
    'shield-check' => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
    'heart-handshake' => '<path d="M19.414 14.414C21 12.828 22 11.5 22 9.5a5.5 5.5 0 0 0-9.591-3.676.6.6 0 0 1-.818.001A5.5 5.5 0 0 0 2 9.5c0 2.3 1.5 4 3 5.5l5.535 5.362a2 2 0 0 0 2.879.052 2.12 2.12 0 0 0-.004-3 2.124 2.124 0 1 0 3-3 2.124 2.124 0 0 0 3.004 0 2 2 0 0 0 0-2.828l-1.881-1.882a2.41 2.41 0 0 0-3.409 0l-1.71 1.71a2 2 0 0 1-2.828 0 2 2 0 0 1 0-2.828l2.823-2.762"/>',
    'microscope' => '<path d="M6 18h8"/><path d="M3 22h18"/><path d="M14 22a7 7 0 1 0 0-14h-1"/><path d="M9 14h2"/><path d="M9 12a2 2 0 0 1-2-2V6h6v4a2 2 0 0 1-2 2Z"/><path d="M12 6V3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3"/>',
    'sofa' => '<path d="M20 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v3"/><path d="M2 16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1.5a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5V11a2 2 0 0 0-4 0z"/><path d="M4 18v2"/><path d="M20 18v2"/><path d="M12 4v9"/>',
    'credit-card' => '<rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/>',
    'navigation' => '<polygon points="3 11 22 2 13 21 11 13 3 11"/>',
    'menu' => '<path d="M4 5h16"/><path d="M4 12h16"/><path d="M4 19h16"/>',
    'x' => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
    'check' => '<path d="M20 6 9 17l-5-5"/>',
    'instagram' => '<rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>',
    'facebook' => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
  ];
  $inner = $map[$name] ?? '';
  return '<svg class="lucide ' . e($class) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $inner . '</svg>';
}

$waLink = whats($cfg);
$mapsQ  = rawurlencode($cfg['maps_query']);

$nav = [
  ['#servicos', 'Serviços'],
  ['#diferenciais', 'Diferenciais'],
  ['#depoimentos', 'Depoimentos'],
  ['#clinica', 'A Clínica'],
  ['#localizacao', 'Localização'],
];

$ldjson = json_encode([
  '@context' => 'https://schema.org',
  '@graph' => [[
    '@type' => ['Dentist', 'LocalBusiness', 'MedicalBusiness'],
    '@id' => '#clinica',
    'name' => $cfg['name'],
    'description' => $cfg['seo_desc'],
    'telephone' => $cfg['phone_raw'],
    'priceRange' => '$$',
    'image' => '/favicon.ico',
    'address' => [
      '@type' => 'PostalAddress',
      'streetAddress' => $cfg['address'],
      'addressLocality' => $cfg['city'],
      'addressRegion' => $cfg['state'],
      'addressCountry' => 'BR',
    ],
    'geo' => ['@type' => 'GeoCoordinates', 'latitude' => $cfg['geo_lat'], 'longitude' => $cfg['geo_lng']],
    'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => $cfg['rating_num'], 'reviewCount' => $cfg['reviews'], 'bestRating' => 5],
    'openingHoursSpecification' => [
      ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'opens' => '08:00', 'closes' => '18:00'],
      ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => 'Saturday', 'opens' => '08:00', 'closes' => '12:00'],
    ],
    'availableService' => array_map(fn($s) => ['@type' => 'MedicalProcedure', 'name' => $s],
      ['Limpeza','Clareamento','Implantes','Ortodontia','Próteses','Tratamento de canal','Extração','Facetas','Odontopediatria']),
  ]],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= e($cfg['seo_title']) ?></title>
  <meta name="description" content="<?= e($cfg['seo_desc']) ?>" />
  <meta property="og:title" content="<?= e($cfg['seo_title']) ?>" />
  <meta property="og:description" content="<?= e($cfg['seo_desc']) ?>" />
  <meta property="og:type" content="website" />
  <meta name="twitter:card" content="summary_large_image" />
  <link rel="canonical" href="/" />
  <link rel="icon" href="favicon.ico" sizes="48x48" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/main.css" />
  <script type="application/ld+json"><?= $ldjson ?></script>
</head>

<body class="min-h-screen bg-background font-sans text-foreground antialiased">

  <!-- Header -->
  <header id="siteHeader" class="fixed inset-x-0 top-0 z-50 transition-all duration-300 py-5">
    <div class="mx-auto grid max-w-7xl grid-cols-[minmax(0,1fr)_auto] items-center gap-4 px-5 lg:px-8">
      <a href="#topo" class="flex min-w-0 items-center gap-3">
        <img src="<?= e($cfg['logo']) ?>" alt="<?= e($cfg['name']) ?>" class="size-11 shrink-0 rounded-full object-contain" />
        <span class="min-w-0">
          <span class="block truncate font-display text-base font-600 leading-tight text-primary"><?= e($cfg['short']) ?></span>
          <span class="block truncate text-xs text-muted-foreground"><?= e($cfg['tagline']) ?></span>
        </span>
      </a>

      <div class="flex items-center gap-2">
        <nav class="hidden items-center gap-7 pr-4 lg:flex">
          <?php foreach ($nav as [$href, $label]): ?>
            <a href="<?= e($href) ?>" class="text-sm font-medium text-muted-foreground transition-colors hover:text-primary"><?= e($label) ?></a>
          <?php endforeach; ?>
        </nav>
        <a href="tel:<?= e($cfg['phone_raw']) ?>" class="hidden items-center gap-2 rounded-full border border-border px-4 py-2.5 text-sm font-semibold text-primary transition-colors hover:bg-secondary sm:inline-flex">
          <?= icon('phone', 'size-4') ?><?= e($cfg['phone']) ?>
        </a>
        <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-full bg-whatsapp px-4 py-2.5 text-sm font-semibold text-whatsapp-foreground shadow-[var(--shadow-soft)] transition-transform hover:scale-[1.03]">
          <?= icon('message-circle', 'size-4') ?>Agendar
        </a>
        <button type="button" id="menuToggle" aria-label="Abrir menu" class="grid size-10 place-items-center rounded-full border border-border text-primary lg:hidden">
          <span data-menu-open><?= icon('menu', 'size-5') ?></span>
          <span data-menu-close class="hidden"><?= icon('x', 'size-5') ?></span>
        </button>
      </div>
    </div>

    <nav id="mobileMenu" class="mx-5 mt-3 hidden rounded-3xl border border-border bg-background p-4 shadow-[var(--shadow-soft)] lg:hidden">
      <?php foreach ($nav as [$href, $label]): ?>
        <a href="<?= e($href) ?>" class="block rounded-2xl px-4 py-3 text-sm font-medium text-foreground transition-colors hover:bg-secondary" data-close-menu><?= e($label) ?></a>
      <?php endforeach; ?>
    </nav>
  </header>

  <main id="topo">
    <!-- Hero -->
    <section class="relative overflow-hidden pt-32 pb-16 lg:pt-40 lg:pb-24" style="background: var(--gradient-soft)">
      <div aria-hidden="true" class="pointer-events-none absolute -top-40 -right-40 size-[36rem] rounded-full bg-accent-soft blur-3xl"></div>
      <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-5 lg:grid-cols-2 lg:gap-16 lg:px-8">
        <div class="reveal">
          <span class="inline-flex items-center gap-2 rounded-full border border-border bg-background px-4 py-2 text-xs font-semibold tracking-wide text-primary uppercase">
            <?= icon('star', 'size-4 fill-gold text-gold') ?>
            <?= e($cfg['rating']) ?> · <?= e($cfg['reviews']) ?> avaliações no Google
          </span>
          <h1 class="mt-6 font-display text-4xl leading-[1.08] font-bold tracking-tight text-primary sm:text-5xl lg:text-6xl">
            Sorria com confiança. <span class="text-accent">Cuidamos da sua saúde bucal</span> com excelência.
          </h1>
          <p class="mt-6 max-w-xl text-lg leading-relaxed text-muted-foreground">
            Atendimento humanizado, tecnologia moderna e profissionais especializados para transformar o seu sorriso — no coração de <?= e($cfg['city']) ?>.
          </p>

          <div class="mt-9 flex flex-col gap-3 sm:flex-row">
            <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 rounded-full bg-whatsapp px-7 py-4 text-base font-semibold text-whatsapp-foreground shadow-[var(--shadow-lift)] transition-transform hover:scale-[1.02]">
              <?= icon('message-circle', 'size-5') ?>Agendar pelo WhatsApp
            </a>
            <a href="tel:<?= e($cfg['phone_raw']) ?>" class="inline-flex items-center justify-center gap-2 rounded-full border border-border bg-background px-7 py-4 text-base font-semibold text-primary transition-colors hover:bg-secondary">
              <?= icon('phone', 'size-5') ?>Ligar agora
            </a>
          </div>

          <p class="mt-5 text-sm text-muted-foreground">
            Agenda limitada por dia para garantir atendimento sem pressa. Respondemos em poucos minutos.
          </p>
        </div>

        <div class="reveal relative" style="transition-delay:120ms">
          <div class="relative overflow-hidden rounded-[2.5rem] shadow-[var(--shadow-lift)]">
            <img src="img/hero-dentista.svg" alt="Paciente sorrindo durante atendimento odontológico na Clínica Odontológica Modelo em Cidade Exemplo" width="1200" height="1408" class="h-full w-full object-cover" />
          </div>
          <div class="absolute -bottom-6 left-4 flex items-center gap-3 rounded-3xl border border-border bg-background/95 px-5 py-4 shadow-[var(--shadow-soft)] backdrop-blur sm:left-8">
            <span class="grid size-11 shrink-0 place-items-center rounded-2xl bg-accent-soft text-accent"><?= icon('shield-check', 'size-5') ?></span>
            <span class="min-w-0">
              <span class="block text-sm font-semibold text-primary">Biossegurança certificada</span>
              <span class="block text-xs text-muted-foreground">Protocolos rigorosos em todas as consultas</span>
            </span>
          </div>
        </div>
      </div>
    </section>

    <!-- Trust bar -->
    <section class="border-y border-border bg-secondary/60">
      <div class="mx-auto grid max-w-7xl gap-6 px-5 py-8 sm:grid-cols-2 lg:grid-cols-5 lg:px-8">
        <?php
          $trust = [
            ['star',            $cfg['rating'] . ' de avaliação',   'Nota média no Google'],
            ['check',           $cfg['reviews'] . ' avaliações',    'Pacientes reais e verificados'],
            ['heart-handshake', 'Atendimento humanizado',           'Sem julgamentos, no seu tempo'],
            ['microscope',      'Equipamentos modernos',            'Diagnóstico digital preciso'],
            ['map-pin',         'Localização central',              'endereço central'],
          ];
          foreach ($trust as [$ic, $t, $sub]): ?>
          <div class="flex min-w-0 items-center gap-3">
            <span class="grid size-10 shrink-0 place-items-center rounded-2xl bg-background text-accent"><?= icon($ic, 'size-5') ?></span>
            <span class="min-w-0">
              <span class="block text-sm font-semibold text-primary"><?= e($t) ?></span>
              <span class="block text-xs text-muted-foreground"><?= e($sub) ?></span>
            </span>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Serviços -->
    <section id="servicos" class="mx-auto max-w-7xl px-5 py-20 lg:px-8 lg:py-28">
      <div class="reveal max-w-2xl">
        <span class="text-sm font-semibold tracking-widest text-accent uppercase">Especialidades</span>
        <h2 class="mt-3 font-display text-3xl font-bold tracking-tight text-primary sm:text-4xl">Tratamentos completos em um só lugar</h2>
        <p class="mt-4 text-lg text-muted-foreground">Do preventivo ao estético: planejamos cada caso individualmente e apresentamos o orçamento antes de iniciar.</p>
      </div>

      <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($cfg['servicos'] as $i => $s): ?>
          <div class="reveal" style="transition-delay:<?= ($i % 3) * 90 ?>ms">
            <article class="surface-card h-full p-7">
              <span class="grid size-12 place-items-center rounded-2xl bg-accent-soft text-accent"><?= icon($s['icon'], 'size-6') ?></span>
              <h3 class="mt-5 font-display text-lg font-semibold text-primary"><?= e($s['title']) ?></h3>
              <p class="mt-2 text-sm leading-relaxed text-muted-foreground"><?= e($s['desc']) ?></p>
            </article>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="reveal mt-10 text-center">
        <a href="<?= e(whats($cfg, 'Olá! Gostaria de saber mais sobre os tratamentos da Clínica Odontológica Modelo.')) ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-full bg-primary px-7 py-4 text-base font-semibold text-primary-foreground transition-transform hover:scale-[1.02]">
          <?= icon('message-circle', 'size-5') ?>Tirar dúvidas sobre meu caso
        </a>
      </div>
    </section>

    <!-- Diferenciais -->
    <section id="diferenciais" class="bg-secondary/50 py-20 lg:py-28">
      <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="reveal max-w-2xl">
          <span class="text-sm font-semibold tracking-widest text-accent uppercase">Diferenciais</span>
          <h2 class="mt-3 font-display text-3xl font-bold tracking-tight text-primary sm:text-4xl">Por que escolher a <?= e($cfg['short']) ?>?</h2>
          <p class="mt-4 text-lg text-muted-foreground">Mais de uma década cuidando de famílias soteropolitanas com o mesmo compromisso: previsibilidade, conforto e resultado.</p>
        </div>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          <?php foreach ($cfg['diferenciais'] as $i => $r): ?>
            <div class="reveal" style="transition-delay:<?= ($i % 3) * 90 ?>ms">
              <div class="surface-card h-full p-7">
                <div class="flex min-w-0 items-center gap-3">
                  <span class="grid size-11 shrink-0 place-items-center rounded-2xl bg-primary text-primary-foreground"><?= icon($r['icon'], 'size-5') ?></span>
                  <h3 class="min-w-0 font-display text-base font-semibold text-primary"><?= e($r['title']) ?></h3>
                </div>
                <p class="mt-4 text-sm leading-relaxed text-muted-foreground"><?= e($r['desc']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Como funciona -->
    <section class="mx-auto max-w-7xl px-5 py-20 lg:px-8 lg:py-28">
      <div class="reveal max-w-2xl">
        <span class="text-sm font-semibold tracking-widest text-accent uppercase">Como funciona</span>
        <h2 class="mt-3 font-display text-3xl font-bold tracking-tight text-primary sm:text-4xl">Do primeiro contato ao sorriso novo em 3 passos</h2>
      </div>

      <div class="mt-12 grid gap-6 lg:grid-cols-3">
        <?php foreach ($cfg['passos'] as $i => $s): ?>
          <div class="reveal" style="transition-delay:<?= $i * 110 ?>ms">
            <div class="relative h-full overflow-hidden rounded-[2rem] border border-border bg-card p-8">
              <span aria-hidden="true" class="absolute -top-4 right-4 font-display text-7xl font-bold text-secondary"><?= e($s['n']) ?></span>
              <span class="relative grid size-12 place-items-center rounded-2xl bg-accent-soft font-display text-base font-bold text-accent"><?= $i + 1 ?></span>
              <h3 class="relative mt-5 font-display text-lg font-semibold text-primary"><?= e($s['title']) ?></h3>
              <p class="relative mt-2 text-sm leading-relaxed text-muted-foreground"><?= e($s['desc']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Depoimentos -->
    <section id="depoimentos" class="bg-secondary/50 py-20 lg:py-28">
      <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="reveal max-w-2xl">
          <span class="text-sm font-semibold tracking-widest text-accent uppercase">Prova social</span>
          <h2 class="mt-3 font-display text-3xl font-bold tracking-tight text-primary sm:text-4xl">Mais de <?= e($cfg['reviews']) ?> avaliações positivas</h2>
          <p class="mt-4 text-lg text-muted-foreground">Nota <?= e($cfg['rating']) ?> de 5 no Google. Veja o que dizem quem já sentou na nossa cadeira.</p>
        </div>

        <div class="mt-12 grid gap-6 lg:grid-cols-3">
          <?php foreach ($cfg['depoimentos'] as $i => $t): ?>
            <div class="reveal" style="transition-delay:<?= $i * 110 ?>ms">
              <figure class="surface-card h-full p-7">
                <div class="flex gap-1 text-gold">
                  <?php for ($k = 0; $k < 5; $k++) echo icon('star', 'size-4 fill-gold'); ?>
                </div>
                <blockquote class="mt-5 text-sm leading-relaxed text-foreground">“<?= e($t['text']) ?>”</blockquote>
                <figcaption class="mt-6 flex min-w-0 items-center gap-3">
                  <span class="grid size-11 shrink-0 place-items-center rounded-full bg-primary font-display text-sm font-semibold text-primary-foreground"><?= e($t['initials']) ?></span>
                  <span class="min-w-0">
                    <span class="block truncate text-sm font-semibold text-primary"><?= e($t['name']) ?></span>
                    <span class="block truncate text-xs text-muted-foreground"><?= e($t['role']) ?></span>
                  </span>
                </figcaption>
              </figure>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Sobre a clínica -->
    <section id="clinica" class="mx-auto max-w-7xl px-5 py-20 lg:px-8 lg:py-28">
      <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">
        <div class="reveal">
          <div class="overflow-hidden rounded-[2.5rem] shadow-[var(--shadow-lift)]">
            <img src="img/clinica-interior.svg" alt="Recepção moderna da Clínica Odontológica Modelo" loading="lazy" width="1200" height="912" class="h-full w-full object-cover" />
          </div>
        </div>
        <div class="reveal" style="transition-delay:100ms">
          <span class="text-sm font-semibold tracking-widest text-accent uppercase">A clínica</span>
          <h2 class="mt-3 font-display text-3xl font-bold tracking-tight text-primary sm:text-4xl">Odontologia de alto padrão no centro de <?= e($cfg['city']) ?></h2>
          <p class="mt-5 leading-relaxed text-muted-foreground"><?= e($cfg['sobre_p1']) ?></p>
          <p class="mt-4 leading-relaxed text-muted-foreground"><?= e($cfg['sobre_p2']) ?></p>
          <dl class="mt-8 grid grid-cols-2 gap-5 sm:grid-cols-3">
            <?php foreach ($cfg['sobre_stats'] as $s): ?>
              <div>
                <dt class="font-display text-3xl font-bold text-accent"><?= e($s['v']) ?></dt>
                <dd class="text-sm text-muted-foreground"><?= e($s['l']) ?></dd>
              </div>
            <?php endforeach; ?>
          </dl>
        </div>
      </div>
    </section>

    <!-- CTA grande + formulário -->
    <section class="relative overflow-hidden py-20 lg:py-24" style="background: var(--gradient-deep)">
      <div class="mx-auto grid max-w-7xl items-center gap-12 px-5 lg:grid-cols-2 lg:px-8">
        <div class="reveal">
          <h2 class="font-display text-3xl font-bold tracking-tight text-primary-foreground sm:text-4xl lg:text-5xl">Pronto para cuidar do seu sorriso?</h2>
          <p class="mt-5 max-w-lg text-lg text-primary-foreground/80">Restam poucos horários de avaliação nesta semana. Fale agora com nossa equipe e garanta o seu.</p>
          <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="mt-9 inline-flex items-center gap-3 rounded-full bg-whatsapp px-9 py-5 text-lg font-semibold text-whatsapp-foreground shadow-[var(--shadow-lift)] transition-transform hover:scale-[1.02]">
            <?= icon('message-circle', 'size-6') ?>Agendar consulta
          </a>
        </div>

        <div class="reveal" style="transition-delay:120ms">
          <form id="contactForm" class="rounded-[2rem] bg-background p-7 shadow-[var(--shadow-lift)]" data-wa-base="https://wa.me/<?= e($cfg['whatsapp_numero']) ?>">
            <h3 class="font-display text-xl font-semibold text-primary">Agende em 30 segundos</h3>
            <p class="mt-2 text-sm text-muted-foreground">Preencha e enviamos sua solicitação direto para o WhatsApp da clínica.</p>
            <div class="mt-6 space-y-4">
              <label class="block">
                <span class="text-sm font-medium text-primary">Seu nome</span>
                <input name="nome" required class="mt-2 w-full rounded-2xl border border-border bg-secondary/40 px-4 py-3 text-sm outline-none focus:border-accent" placeholder="Como podemos te chamar?" />
              </label>
              <label class="block">
                <span class="text-sm font-medium text-primary">WhatsApp</span>
                <input name="telefone" required inputmode="tel" class="mt-2 w-full rounded-2xl border border-border bg-secondary/40 px-4 py-3 text-sm outline-none focus:border-accent" placeholder="(00) 00000-0000" />
              </label>
              <label class="block">
                <span class="text-sm font-medium text-primary">O que você procura?</span>
                <select name="servico" class="mt-2 w-full rounded-2xl border border-border bg-secondary/40 px-4 py-3 text-sm outline-none focus:border-accent">
                  <option>Avaliação geral</option>
                  <?php foreach ($cfg['servicos'] as $s): ?><option><?= e($s['title']) ?></option><?php endforeach; ?>
                </select>
              </label>
            </div>
            <button type="submit" class="mt-6 w-full rounded-full bg-primary px-6 py-4 text-base font-semibold text-primary-foreground transition-transform hover:scale-[1.02]">Enviar e falar no WhatsApp</button>
            <p class="mt-3 text-center text-xs text-muted-foreground">Seus dados são usados apenas para o agendamento.</p>
          </form>
        </div>
      </div>
    </section>

    <!-- Localização -->
    <section id="localizacao" class="mx-auto max-w-7xl px-5 py-20 lg:px-8 lg:py-28">
      <div class="grid gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:gap-14">
        <div class="reveal">
          <span class="text-sm font-semibold tracking-widest text-accent uppercase">Localização</span>
          <h2 class="mt-3 font-display text-3xl font-bold tracking-tight text-primary sm:text-4xl">Fácil de chegar, no coração de <?= e($cfg['city']) ?></h2>
          <ul class="mt-8 space-y-5 text-sm">
            <li class="flex gap-3">
              <?= icon('map-pin', 'mt-0.5 size-5 shrink-0 text-accent') ?>
              <span class="text-muted-foreground"><?= e($cfg['address']) ?><br /><?= e($cfg['city']) ?> - <?= e($cfg['state']) ?></span>
            </li>
            <li class="flex gap-3">
              <?= icon('clock', 'mt-0.5 size-5 shrink-0 text-accent') ?>
              <span class="text-muted-foreground"><?= e($cfg['horario_semana']) ?><br /><?= e($cfg['horario_sabado']) ?></span>
            </li>
            <li class="flex gap-3">
              <?= icon('phone', 'mt-0.5 size-5 shrink-0 text-accent') ?>
              <a href="tel:<?= e($cfg['phone_raw']) ?>" class="font-semibold text-primary hover:underline"><?= e($cfg['phone']) ?></a>
            </li>
          </ul>
          <a href="https://www.google.com/maps/dir/?api=1&destination=<?= $mapsQ ?>" target="_blank" rel="noopener noreferrer" class="mt-8 inline-flex items-center gap-2 rounded-full bg-primary px-7 py-4 text-base font-semibold text-primary-foreground transition-transform hover:scale-[1.02]">
            <?= icon('navigation', 'size-5') ?>Como chegar
          </a>
        </div>

        <div class="reveal" style="transition-delay:100ms">
          <div class="overflow-hidden rounded-[2rem] border border-border shadow-[var(--shadow-soft)]">
            <iframe title="Mapa da Clínica Odontológica Modelo" src="https://www.google.com/maps?q=<?= $mapsQ ?>&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="h-[420px] w-full border-0"></iframe>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Rodapé -->
  <footer class="border-t border-border bg-secondary/60">
    <div class="mx-auto grid max-w-7xl gap-10 px-5 py-14 sm:grid-cols-2 lg:grid-cols-4 lg:px-8">
      <div>
        <span class="font-display text-lg font-semibold text-primary"><?= e($cfg['name']) ?></span>
        <p class="mt-3 text-sm leading-relaxed text-muted-foreground">Odontologia humanizada e de alto padrão em <?= e($cfg['city']) ?>. Nota <?= e($cfg['rating']) ?> com <?= e($cfg['reviews']) ?> avaliações.</p>
      </div>
      <div>
        <h3 class="text-sm font-semibold text-primary">Contato</h3>
        <ul class="mt-4 space-y-2 text-sm text-muted-foreground">
          <li><a href="tel:<?= e($cfg['phone_raw']) ?>" class="hover:text-primary">Telefone: <?= e($cfg['phone']) ?></a></li>
          <li><a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="hover:text-primary">WhatsApp: <?= e($cfg['phone']) ?></a></li>
        </ul>
      </div>
      <div>
        <h3 class="text-sm font-semibold text-primary">Endereço</h3>
        <p class="mt-4 text-sm text-muted-foreground"><?= e($cfg['address']) ?><br /><?= e($cfg['city']) ?> - <?= e($cfg['state']) ?></p>
        <h3 class="mt-5 text-sm font-semibold text-primary">Horário</h3>
        <p class="mt-2 text-sm text-muted-foreground">Seg a Sex 08h–18h · Sáb 08h–12h</p>
      </div>
      <div>
        <h3 class="text-sm font-semibold text-primary">Redes sociais</h3>
        <div class="mt-4 flex gap-3">
          <a href="<?= e($cfg['instagram']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="grid size-11 place-items-center rounded-2xl border border-border bg-background text-primary transition-colors hover:bg-secondary"><?= icon('instagram', 'size-5') ?></a>
          <a href="<?= e($cfg['facebook']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="grid size-11 place-items-center rounded-2xl border border-border bg-background text-primary transition-colors hover:bg-secondary"><?= icon('facebook', 'size-5') ?></a>
          <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" class="grid size-11 place-items-center rounded-2xl bg-whatsapp text-whatsapp-foreground"><?= icon('message-circle', 'size-5') ?></a>
        </div>
      </div>
    </div>
    <div class="border-t border-border py-6 text-center text-xs text-muted-foreground">
      © <?= date('Y') ?> <?= e($cfg['name']) ?>. Todos os direitos reservados.
    </div>
  </footer>

  <!-- Botão flutuante -->
  <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" aria-label="Agendar pelo WhatsApp" class="fixed right-5 bottom-5 z-50 inline-flex items-center gap-2 rounded-full bg-whatsapp px-5 py-4 font-semibold text-whatsapp-foreground shadow-[var(--shadow-lift)] transition-transform hover:scale-105">
    <?= icon('message-circle', 'size-6') ?><span class="hidden sm:inline">Agendar no WhatsApp</span>
  </a>

  <script src="js/app.js"></script>
</body>
</html>
