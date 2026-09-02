<?php
/**
 * Configuração da Clínica — edite aqui todos os dados e textos do site.
 * Mesma ideia do projeto clinica_mrodonto: o HTML não muda, só este arquivo.
 */
return [
  // ====== Identidade ======
  'name'   => 'Clínica Odontológica Modelo',
  'short'  => 'Odonto Modelo',
  'tagline' => 'Odontologia · Cidade Exemplo',
  'logo'   => 'img/logo.svg',

  // ====== Contato ======
  'phone'          => '(00) 0000-0000',
  'phone_raw'      => '+5500000000000',
  'whatsapp_numero' => '5500000000000',
  'whatsapp_msg'   => 'Olá! Vim pelo site e gostaria de agendar uma avaliação na Clínica Odontológica Modelo.',

  // ====== Endereço ======
  'address' => 'Rua Exemplo, 000 - Sala 00',
  'city'    => 'Cidade Exemplo',
  'state'   => 'UF',
  'maps_query' => 'Rua Exemplo, 000, Cidade Exemplo · UF',
  'geo_lat'    => 0,
  'geo_lng'    => 0,

  // ====== Avaliações ======
  'rating'  => '4,9',
  'rating_num' => 4.9,
  'reviews' => 82,

  // ====== Horário ======
  'horario_semana' => 'Seg a Sex: 08h às 18h',
  'horario_sabado' => 'Sábado: 08h às 12h',

  // ====== Redes sociais ======
  'instagram' => '',
  'facebook'  => 'https://facebook.com',

  // ====== SEO ======
  'seo_title' => 'Dentista em Cidade Exemplo | Clínica Odontológica Modelo',
  'seo_desc'  => 'Clínica odontológica em Cidade Exemplo com nota 4,9 (82 avaliações). Implantes, clareamento, ortodontia e mais. Agende sua avaliação pelo WhatsApp.',

  // ====== Serviços / Especialidades ======
  'servicos' => [
    ['icon' => 'sparkles',   'title' => 'Limpeza e Prevenção',   'desc' => 'Profilaxia completa que remove tártaro e evita tratamentos caros no futuro.'],
    ['icon' => 'smile',      'title' => 'Clareamento Dental',    'desc' => 'Dentes visivelmente mais brancos com protocolo seguro e sem sensibilidade.'],
    ['icon' => 'anchor',     'title' => 'Implantes',             'desc' => 'Reposição de dentes com estética natural e mastigação totalmente recuperada.'],
    ['icon' => 'align-horizontal-distribute-center', 'title' => 'Ortodontia', 'desc' => 'Aparelhos convencionais, estéticos e alinhadores para um sorriso alinhado.'],
    ['icon' => 'layers',     'title' => 'Próteses',              'desc' => 'Próteses fixas e removíveis planejadas para conforto e naturalidade.'],
    ['icon' => 'stethoscope','title' => 'Tratamento de Canal',   'desc' => 'Endodontia com anestesia eficaz: alívio da dor já na primeira sessão.'],
    ['icon' => 'scissors',   'title' => 'Extração',              'desc' => 'Cirurgias seguras, incluindo sisos, com recuperação rápida e acompanhada.'],
    ['icon' => 'gem',        'title' => 'Facetas',               'desc' => 'Design de sorriso em resina ou porcelana para harmonia total do rosto.'],
    ['icon' => 'baby',       'title' => 'Odontopediatria',       'desc' => 'Atendimento lúdico e acolhedor para que seu filho ame ir ao dentista.'],
  ],

  // ====== Diferenciais ======
  'diferenciais' => [
    ['icon' => 'heart-handshake', 'title' => 'Atendimento Humanizado',    'desc' => 'Escuta atenta, explicação de cada etapa e zero julgamento sobre o seu caso.'],
    ['icon' => 'shield-check',    'title' => 'Profissionais Experientes', 'desc' => 'Equipe especializada, com formação continuada e protocolos de biossegurança.'],
    ['icon' => 'microscope',      'title' => 'Equipamentos Modernos',     'desc' => 'Diagnóstico digital e tecnologia que torna o tratamento mais rápido e preciso.'],
    ['icon' => 'sofa',            'title' => 'Ambiente Confortável',      'desc' => 'Estrutura pensada para reduzir a ansiedade desde a sala de espera.'],
    ['icon' => 'credit-card',     'title' => 'Particular e Convênios',    'desc' => 'Condições facilitadas e atendimento a convênios: orçamento transparente.'],
    ['icon' => 'map-pin',         'title' => 'Localização Central',       'desc' => 'endereço central, fácil acesso e estacionamento próximo em Cidade Exemplo.'],
  ],

  // ====== Como funciona ======
  'passos' => [
    ['n' => '01', 'title' => 'Entre em contato',    'desc' => 'Chame no WhatsApp e conte rapidamente o que está incomodando. Resposta no mesmo dia.'],
    ['n' => '02', 'title' => 'Agende sua consulta', 'desc' => 'Escolhemos o melhor horário para você e preparamos sua avaliação com plano e valores claros.'],
    ['n' => '03', 'title' => 'Transforme seu sorriso', 'desc' => 'Tratamento conduzido por especialistas, com acompanhamento até o resultado final.'],
  ],

  // ====== Depoimentos ======
  'depoimentos' => [
    ['name' => 'Juliana Menezes',  'role' => 'Clareamento e limpeza', 'initials' => 'JM', 'text' => 'Tinha muito medo de dentista e saí de lá tranquila. Explicaram cada passo e o resultado do clareamento ficou natural. Já indiquei para minha família toda.'],
    ['name' => 'Ricardo Andrade',  'role' => 'Implante unitário',     'initials' => 'RA', 'text' => 'Perdi um dente da frente e achei que nunca mais sorriria igual. O implante ficou idêntico aos outros. Atendimento pontual e clínica impecável.'],
    ['name' => 'Camila Torres',    'role' => 'Ortodontia',            'initials' => 'CT', 'text' => 'Em 14 meses meu sorriso mudou completamente. Cada consulta foi no horário marcado, sem enrolação, e o orçamento nunca mudou do combinado.'],
  ],

  // ====== Sobre a clínica ======
  'sobre_p1' => 'A Clínica Odontológica Modelo nasceu do compromisso de unir precisão técnica e acolhimento verdadeiro. Cada paciente é recebido por uma equipe que estuda o caso antes de propor qualquer tratamento — nada de procedimentos desnecessários.',
  'sobre_p2' => 'Investimos continuamente em tecnologia de diagnóstico, materiais de primeira linha e protocolos de biossegurança auditados. O resultado é um atendimento previsível, confortável e com garantia de acompanhamento em todas as etapas.',
  'sobre_stats' => [
    ['v' => '10+',  'l' => 'anos de atuação'],
    ['v' => '4,9★', 'l' => 'nota no Google'],
    ['v' => '9',    'l' => 'especialidades'],
  ],
];
