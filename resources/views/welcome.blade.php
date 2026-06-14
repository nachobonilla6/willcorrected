<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $content->meta_title ?? 'wilcorrected' }}</title>
  <meta name="description" content="{{ $content->meta_description ?? 'wilcorrected project' }}" />
  <meta name="theme-color" content="#0d2818" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,500;0,600;1,300;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body>
  <!-- ===== NAV ===== -->
  <nav id="navbar">
    <div class="nav-inner">
      <span class="nav-logo">La Paloma Blanca <span class="nav-logo-tag">For Sale</span></span>
      <ul class="nav-links">
        <li><a href="#details">Details</a></li>
        <li><a href="#amenities">Amenities</a></li>
        <li><a href="#gallery">Gallery</a></li>
        <li><a href="#video">Video</a></li>
        <li><a href="#beach">The Beach</a></li>
        <li><a href="#contact" class="nav-cta">Contact</a></li>
      </ul>
      <button class="nav-toggle" id="navToggle" aria-label="Menu">
        <i class="fas fa-bars"></i>
      </button>
    </div>
  </nav>

  <!-- ===== HERO ===== -->
  <section class="hero" id="hero"@if($content->hero_image) style="background-image: url('{{ asset($content->hero_image) }}'); background-size: cover; background-position: center;"@endif>
    <div class="hero-overlay"></div>
    <div class="hero-bg-scroll"></div>
    <div class="hero-content">
      <div class="hero-badge animate-fade-in">{{ $content->hero_badge ?? 'wilcorrected' }}</div>
      <h1 class="animate-fade-in-up">{{ $content->hero_title ?? 'Bienvenido' }}<br /><span class="hero-accent">{{ $content->hero_accent ?? 'Hola Mundo' }}</span></h1>
      <p class="hero-subtitle animate-fade-in-up">{{ $content->hero_subtitle ?? 'Proyecto Laravel' }}</p>
      @if($content->hero_tagline)
      <p class="hero-tagline animate-fade-in-up">{!! nl2br(e($content->hero_tagline)) !!}</p>
      @endif
      <div class="hero-actions animate-fade-in-up">
        <a href="#details" class="btn btn-primary">Explore</a>
        <a href="#contact" class="btn btn-outline">Schedule a Viewing</a>
      </div>
    </div>
    <div class="hero-scroll-hint">
      <span>Scroll</span>
      <i class="fas fa-chevron-down"></i>
    </div>
  </section>

  <!-- ===== DETAILS ===== -->
  <section id="details" class="section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-label">The Property</span>
        <h2>{{ $content->details_title ?? 'Detalles del Proyecto' }}</h2>
        @if($content->details_intro)
        <p class="section-intro">{{ $content->details_intro }}</p>
        @endif
      </div>

      @php
        $features = $content->feature_list ?? [];
        $lifeHighlights = $content->life_highlights ?? [];
      @endphp

      <div class="details-grid">
        <div class="details-text animate-on-scroll">
          <h3 class="details-subtitle">Property Features</h3>
          @if(!empty($features))
            <ul class="feature-list">
              @foreach($features as $feature)
                <li><i class="{{ $feature['icon'] ?? 'fas fa-check' }}"></i> {{ $feature['text'] ?? '' }}</li>
              @endforeach
            </ul>
          @else
            <ul class="feature-list">
              <li><i class="fas fa-bed"></i> 2 spacious bedrooms</li>
              <li><i class="fas fa-bath"></i> 2 full bathrooms</li>
              <li><i class="fas fa-vector-square"></i> Approximately 1,000 sq ft of living space</li>
              <li><i class="fas fa-car"></i> Dedicated owner parking</li>
              <li><i class="fas fa-shield-alt"></i> 24-hour gated security</li>
              <li><i class="fas fa-swimmer"></i> Four swimming pools</li>
              <li><i class="fas fa-leaf"></i> Tropical gardens throughout the property</li>
              <li><i class="fas fa-umbrella-beach"></i> Direct beach access</li>
              <li><i class="fas fa-chart-line"></i> Strong rental and investment potential</li>
            </ul>
          @endif
          @if($content->details_description)
            <p>{{ $content->details_description }}</p>
          @endif
          <a href="#contact" class="btn btn-primary">Schedule a Viewing</a>
        </div>
        <div class="details-image animate-on-scroll">
          @if($content->details_image)
          <img src="{{ asset($content->details_image) }}" alt="La Paloma Blanca" />
          @endif
        </div>
      </div>

      @if($content->life_title || $content->life_text)
      <div class="life-section animate-on-scroll">
        <h3>{{ $content->life_title ?? 'Life at La Paloma Blanca' }}</h3>
        @if($content->life_text)<p>{{ $content->life_text }}</p>@endif
        @if(!empty($lifeHighlights))
        <div class="life-highlights">
          @foreach($lifeHighlights as $item)
          <div class="life-item">
            <i class="{{ $item['icon'] ?? 'fas fa-check' }} life-icon"></i>
            <span>{{ $item['text'] ?? '' }}</span>
          </div>
          @endforeach
        </div>
        @endif
      </div>
      @endif

      @if($content->surf_title || $content->surf_text)
      <div class="surf-section animate-on-scroll">
        <h3>{{ $content->surf_title ?? "A Surfer's Paradise" }}</h3>
        @if($content->surf_text)<p>{{ $content->surf_text }}</p>@endif
      </div>
      @endif
    </div>
  </section>

  <!-- ===== AMENITIES ===== -->
  <section id="amenities" class="section section-alt">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-label">Complex Amenities</span>
        <h2>Resort-Style Living</h2>
      </div>
      @if($amenities->count())
      <div class="amenities-grid">
        @foreach($amenities as $amenity)
        <div class="amenity-card animate-on-scroll">
          @if($amenity->icon)<div class="amenity-icon-wrap"><i class="{{ $amenity->icon }}"></i></div>@endif
          <h3>{{ $amenity->title }}</h3>
          @if($amenity->description)<p>{{ $amenity->description }}</p>@endif
        </div>
        @endforeach
      </div>
      @endif
    </div>
  </section>

  <!-- ===== GALLERY ===== -->
  <section id="gallery" class="section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-label">Gallery</span>
        <h2>Photos</h2>
      </div>
      @if($images->count())
      <div class="gallery-grid">
        @foreach($images as $img)
        <div class="gallery-item animate-on-scroll">
          <img src="{{ asset($img->image_path) }}" alt="{{ $img->alt_text }}" loading="lazy" />
        </div>
        @endforeach
      </div>
      @endif
    </div>
  </section>

  <!-- ===== VIDEO TOUR ===== -->
  <section id="video" class="section section-alt">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-label">Video Tour</span>
        <h2>{{ $content->video_title ?? 'See the Neighborhood' }}</h2>
        @if($content->video_intro)<p class="section-intro">{{ $content->video_intro }}</p>@endif
      </div>
      <div class="video-grid">
        @if($content->video_1_src ?? false)
        <div class="video-card animate-on-scroll">
          <video controls>
            <source src="{{ asset($content->video_1_src) }}" type="video/mp4" />
          </video>
          @if($content->video_1_label)<p class="video-label"><i class="fas fa-road"></i> {{ $content->video_1_label }}</p>@endif
        </div>
        @endif
        @if($content->video_2_src ?? false)
        <div class="video-card animate-on-scroll">
          <video controls>
            <source src="{{ asset($content->video_2_src) }}" type="video/mp4" />
          </video>
          @if($content->video_2_label)<p class="video-label"><i class="fas fa-building"></i> {{ $content->video_2_label }}</p>@endif
        </div>
        @endif
      </div>
    </div>
  </section>

  <!-- ===== THE BEACH ===== -->
  <section id="beach" class="section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-label">The Beach</span>
        <h2>Your New Backyard</h2>
        @if($content->beach_intro)<p class="section-intro">{{ $content->beach_intro }}</p>@endif
      </div>

      @php $beachHighlights = $content->beach_highlights ?? []; @endphp

      <div class="beach-content">
        @if($content->beach_text_1 || $content->beach_text_2)
        <div class="beach-text animate-on-scroll">
          @if($content->beach_text_1)<p>{{ $content->beach_text_1 }}</p>@endif
          @if($content->beach_text_2)<p>{{ $content->beach_text_2 }}</p>@endif
        </div>
        @endif
        @if($content->beach_image_1 || $content->beach_image_2)
        <div class="beach-images animate-on-scroll">
          @if($content->beach_image_1) <img src="{{ asset($content->beach_image_1) }}" alt="Sunset at South Jacó beach" /> @endif
          @if($content->beach_image_2) <img src="{{ asset($content->beach_image_2) }}" alt="Street leading to the beach" /> @endif
        </div>
        @endif
      </div>

      @if(!empty($beachHighlights))
      <div class="beach-highlights animate-on-scroll">
        <h3>{{ $content->beach_highlights_title ?? 'Beach Highlights' }}</h3>
        <div class="highlights-list">
          @foreach($beachHighlights as $item)
          <div class="highlight-item"><i class="fas fa-check"></i> {{ $item['text'] ?? '' }}</div>
          @endforeach
        </div>
      </div>
      @endif

      @if($content->surfing_title || $content->surfing_text)
      <div class="beach-subsection animate-on-scroll">
        <h3>{{ $content->surfing_title ?? 'Surfing' }}</h3>
        <p>{{ $content->surfing_text ?? '' }}</p>
      </div>
      @endif

      @if($content->sunset_title || $content->sunset_text)
      <div class="beach-subsection animate-on-scroll">
        <h3>{{ $content->sunset_title ?? 'Sunset Views' }}</h3>
        <p>{{ $content->sunset_text ?? '' }}</p>
      </div>
      @endif
    </div>
  </section>

  <!-- ===== ARTICLES ===== -->
  <section id="articles" class="section section-alt">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-label">Why Costa Rica</span>
        <h2>Happiest Country in the World</h2>
        <p class="section-intro">Costa Rica consistently ranks among the happiest and most peaceful nations.</p>
      </div>
      @if($articles->count())
      <div class="articles-list">
        @foreach($articles as $article)
        <a href="{{ $article->url }}" target="_blank" rel="noopener" class="article-card animate-on-scroll">
          <span class="article-source">{{ $article->source }}</span>
          <span class="article-title">{{ $article->title }}</span>
          @if($article->description)<span class="article-desc">{{ $article->description }}</span>@endif
        </a>
        @endforeach
      </div>
      @endif
    </div>
  </section>

  <!-- ===== CONTACT ===== -->
  <section id="contact" class="section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-label">Get in Touch</span>
        <h2>{{ $content->contact_title ?? 'Interested in This Property?' }}</h2>
        <p class="section-intro">
          This is my personal unit — I'm selling it directly, no agents involved.
          Reach out anytime for more information or to schedule a private viewing.
        </p>
      </div>
      @php $hasContact = $content && ($content->contact_email || $content->contact_phone || $content->contact_whatsapp); @endphp
      @if($hasContact)
      <div class="contact-grid">
        <div class="contact-card animate-on-scroll">
          <div class="contact-card-icon"><i class="fas fa-map-marker-alt"></i></div>
          <h3>Location</h3>
          <p>La Paloma Blanca<br />South Jacó, Costa Rica</p>
        </div>
        @if($content->owner_name)
        <div class="contact-card animate-on-scroll">
          <div class="contact-card-icon"><i class="fas fa-user"></i></div>
          <h3>Owner</h3>
          <p>{{ $content->owner_name }}<br />Direct from owner, no agents</p>
        </div>
        @endif
        @if($content->contact_email)
        <div class="contact-card animate-on-scroll">
          <div class="contact-card-icon"><i class="fas fa-envelope"></i></div>
          <h3>Email</h3>
          <p><a href="mailto:{{ $content->contact_email }}">{{ $content->contact_email }}</a></p>
        </div>
        @endif
        @if($content->contact_phone)
        <div class="contact-card animate-on-scroll">
          <div class="contact-card-icon"><i class="fas fa-phone-alt"></i></div>
          <h3>Phone</h3>
          <p><a href="tel:{{ $content->contact_phone }}">{{ $content->contact_phone }}</a></p>
        </div>
        @endif
      </div>
      @endif
    </div>
  </section>

  <!-- ===== FOOTER ===== -->
  <footer>
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <h4>wilcorrected</h4>
          <p>Laravel Project</p>
        </div>
        <div class="footer-links">
          <a href="#details">Details</a>
          <a href="#amenities">Amenities</a>
          <a href="#gallery">Gallery</a>
          <a href="#video">Video</a>
          <a href="#beach">The Place</a>
          <a href="#contact">Contact</a>
        </div>
        <div class="footer-contact">
          <p>wilcorrected</p>
          <a href="mailto:hello@wilcorrected.com">hello@wilcorrected.com</a>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} wilcorrected &mdash; All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Lightbox -->
  <div id="lightbox" class="lightbox hidden">
    <span class="lightbox-close">&times;</span>
    <button class="lightbox-prev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
    <img class="lightbox-img" id="lightboxImg" src="" alt="" />
    <button class="lightbox-next" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
    <div class="lightbox-counter" id="lightboxCounter"></div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
