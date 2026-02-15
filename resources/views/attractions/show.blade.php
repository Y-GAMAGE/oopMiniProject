@extends('layouts.app')

@section('title', $attraction->name . ' - ' . $district->name . ' - TravelEase')

@section('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        background: #f9fafb;
    }

    /* Image Carousel */
    .carousel-container {
        position: relative;
        width: 100%;
        height: 500px;
        background: #000;
        overflow: hidden;
    }

    .carousel-slide {
        display: none;
        width: 100%;
        height: 100%;
    }

    .carousel-slide.active {
        display: block;
    }

    .carousel-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .carousel-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.9);
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        z-index: 10;
    }

    .carousel-btn:hover {
        background: white;
        transform: translateY(-50%) scale(1.1);
    }

    .carousel-btn.prev {
        left: 20px;
    }

    .carousel-btn.next {
        right: 20px;
    }

    .carousel-indicators {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 10;
    }

    .carousel-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        border: 2px solid white;
        cursor: pointer;
        transition: all 0.3s;
    }

    .carousel-indicator.active {
        background: white;
        width: 32px;
        border-radius: 6px;
    }

    .carousel-counter {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        z-index: 10;
    }

    .thumbnail-strip {
        position: absolute;
        bottom: 60px;
        left: 20px;
        right: 20px;
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding: 10px 0;
        z-index: 10;
    }

    .thumbnail-strip::-webkit-scrollbar {
        height: 6px;
    }

    .thumbnail-strip::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.5);
        border-radius: 3px;
    }

    .thumbnail {
        min-width: 80px;
        height: 60px;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.3s;
    }

    .thumbnail.active {
        border-color: white;
        transform: scale(1.05);
    }

    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Main Content */
    .content-container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 40px 32px 80px;
    }

    /* Breadcrumb */
    .breadcrumb {
        display: flex;
        gap: 8px;
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .breadcrumb a {
        color: #1e3a8a;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    /* Header Section */
    .attraction-header {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 32px;
        margin-bottom: 40px;
        align-items: start;
    }

    .header-left h1 {
        font-size: 48px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 16px;
        line-height: 1.2;
    }

    .tags-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .tag {
        padding: 8px 16px;
        background: #e0e7ff;
        color: #1e3a8a;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .tag.unesco {
        background: #fef3c7;
        color: #92400e;
    }

    .tag.featured {
        background: #d1fae5;
        color: #065f46;
    }

    .meta-row {
        display: flex;
        align-items: center;
        gap: 24px;
        flex-wrap: wrap;
    }

    .rating-display {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 18px;
    }

    .rating-number {
        font-size: 24px;
        font-weight: 700;
        color: #f59e0b;
    }

    .rating-stars {
        color: #f59e0b;
        font-size: 20px;
    }

    .reviews-count {
        color: #6b7280;
        font-size: 14px;
    }

    .location-display {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #6b7280;
        font-size: 16px;
    }

    .add-to-trip-btn {
        padding: 16px 32px;
        background: #1e3a8a;
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s;
        box-shadow: 0 4px 16px rgba(30, 58, 138, 0.3);
    }

    .add-to-trip-btn:hover {
        background: #1e40af;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(30, 58, 138, 0.4);
    }

    .share-btn {
        padding: 16px;
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 20px;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 12px;
    }

    .share-btn:hover {
        border-color: #1e3a8a;
        background: #f9fafb;
    }

    /* Two Column Layout */
    .two-column-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 32px;
        margin-bottom: 48px;
    }

    /* About Section */
    .section-card {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    }

    .section-title {
        font-size: 28px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .about-text {
        font-size: 16px;
        line-height: 1.8;
        color: #374151;
        margin-bottom: 24px;
    }

    .highlights-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-top: 24px;
    }

    .highlight-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px;
        background: #f9fafb;
        border-radius: 10px;
        font-size: 14px;
        color: #374151;
    }

    .highlight-check {
        color: #059669;
        font-size: 18px;
    }

    /* Quick Facts */
    .quick-facts-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .fact-item {
        display: flex;
        justify-content: space-between;
        padding: 16px;
        background: #f9fafb;
        border-radius: 10px;
        font-size: 14px;
    }

    .fact-label {
        color: #6b7280;
        font-weight: 600;
    }

    .fact-value {
        color: #1e3a8a;
        font-weight: 700;
        text-align: right;
    }

    /* Weather Widget */
    .weather-widget {
        background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        color: white;
        padding: 24px;
        border-radius: 16px;
        text-align: center;
        margin-top: 24px;
    }

    .weather-icon {
        font-size: 64px;
        margin-bottom: 12px;
    }

    .weather-temp {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .weather-condition {
        font-size: 18px;
        opacity: 0.9;
    }

    .weather-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-top: 20px;
    }

    .weather-detail {
        text-align: center;
    }

    .weather-detail-value {
        font-size: 20px;
        font-weight: 700;
    }

    .weather-detail-label {
        font-size: 12px;
        opacity: 0.8;
    }

    /* Visitor Information */
    .visitor-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .info-box {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    }

    .info-box-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .hours-table {
        font-size: 14px;
    }

    .hours-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .hours-row:last-child {
        border-bottom: none;
    }

    .day-label {
        color: #6b7280;
        font-weight: 600;
    }

    .time-label {
        color: #374151;
        font-weight: 600;
    }

    .ceremony-note {
        font-size: 12px;
        color: #6b7280;
        margin-top: 12px;
        font-style: italic;
    }

    .fee-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .fee-row {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        background: #f9fafb;
        border-radius: 8px;
        font-size: 14px;
    }

    .fee-type {
        color: #6b7280;
    }

    .fee-amount {
        color: #059669;
        font-weight: 700;
    }

    .best-time-content {
        font-size: 14px;
        line-height: 1.6;
        color: #374151;
    }

    .time-badge {
        display: inline-block;
        padding: 6px 12px;
        background: #fef3c7;
        color: #92400e;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 12px;
    }

    .duration-box {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        background: #eff6ff;
        border-radius: 10px;
        margin-top: 12px;
    }

    .duration-icon {
        font-size: 32px;
    }

    .duration-text {
        font-size: 18px;
        font-weight: 700;
        color: #1e3a8a;
    }

    .languages-list {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 12px;
    }

    .language-badge {
        padding: 6px 12px;
        background: #e0e7ff;
        color: #1e3a8a;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    /* Facilities Section */
    .facilities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 20px;
        margin-top: 24px;
    }

    .facility-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        padding: 20px;
        background: #f9fafb;
        border-radius: 16px;
        text-align: center;
        transition: all 0.3s;
    }

    .facility-card:hover {
        background: #e0e7ff;
        transform: translateY(-4px);
    }

    .facility-icon {
        font-size: 48px;
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .facility-name {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    /* Nearby Section */
    .nearby-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
        margin: 48px 0;
    }

    .nearby-card {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    }

    .nearby-grid {
        display: grid;
        gap: 16px;
        margin-top: 20px;
    }

    .nearby-item {
        display: grid;
        grid-template-columns: 100px 1fr;
        gap: 16px;
        padding: 16px;
        background: #f9fafb;
        border-radius: 12px;
        transition: all 0.3s;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
    }

    .nearby-item:hover {
        background: #eff6ff;
        transform: translateX(4px);
    }

    .nearby-image {
        width: 100px;
        height: 80px;
        border-radius: 10px;
        overflow: hidden;
    }

    .nearby-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .nearby-info h4 {
        font-size: 16px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 6px;
    }

    .nearby-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
        color: #6b7280;
    }

    .nearby-rating {
        color: #f59e0b;
        font-weight: 600;
    }

    .nearby-distance {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .view-all-btn {
        display: inline-block;
        width: 100%;
        padding: 14px;
        background: #1e3a8a;
        color: white;
        text-align: center;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        margin-top: 16px;
        transition: all 0.3s;
    }

    .view-all-btn:hover {
        background: #1e40af;
        transform: translateY(-2px);
    }

    /* You May Also Like */
    .similar-attractions {
        margin: 48px 0;
    }

    .similar-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-top: 24px;
    }

    .similar-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
    }

    .similar-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
    }

    .similar-image {
        height: 180px;
        overflow: hidden;
    }

    .similar-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .similar-card:hover .similar-image img {
        transform: scale(1.1);
    }

    .similar-content {
        padding: 16px;
    }

    .similar-name {
        font-size: 16px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .similar-rating {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        color: #f59e0b;
        font-weight: 600;
    }

    .similar-distance {
        font-size: 12px;
        color: #6b7280;
        margin-top: 6px;
    }

    /* Reviews Section */
    .reviews-section {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    }

    .reviews-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }

    .reviews-summary {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 32px;
        padding: 32px;
        background: #f9fafb;
        border-radius: 16px;
        margin-bottom: 32px;
    }

    .overall-rating {
        text-align: center;
    }

    .overall-number {
        font-size: 64px;
        font-weight: 700;
        color: #1e3a8a;
        line-height: 1;
        margin-bottom: 12px;
    }

    .overall-stars {
        font-size: 24px;
        color: #f59e0b;
        margin-bottom: 8px;
    }

    .overall-count {
        font-size: 14px;
        color: #6b7280;
    }

    .rating-breakdown {
        flex: 1;
    }

    .rating-bar-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .rating-label {
        font-size: 14px;
        color: #374151;
        font-weight: 600;
        min-width: 30px;
    }

    .rating-bar-container {
        flex: 1;
        height: 10px;
        background: #e5e7eb;
        border-radius: 5px;
        overflow: hidden;
    }

    .rating-bar-fill {
        height: 100%;
        background: #f59e0b;
        transition: width 0.5s ease;
    }

    .rating-percentage {
        font-size: 14px;
        color: #6b7280;
        min-width: 40px;
        text-align: right;
    }

    .write-review-btn {
        padding: 14px 28px;
        background: #1e3a8a;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .write-review-btn:hover {
        background: #1e40af;
        transform: translateY(-2px);
    }

    .reviews-list {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .review-card {
        padding: 24px;
        border: 2px solid #f3f4f6;
        border-radius: 16px;
        transition: all 0.3s;
    }

    .review-card:hover {
        border-color: #e0e7ff;
        background: #f9fafb;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 16px;
    }

    .reviewer-info {
        display: flex;
        gap: 12px;
    }

    .reviewer-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        background: #e0e7ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .reviewer-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .reviewer-details h4 {
        font-size: 16px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 4px;
    }

    .review-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
        color: #6b7280;
    }

    .review-rating {
        display: flex;
        align-items: center;
        gap: 4px;
        color: #f59e0b;
    }

    .review-date {
        color: #6b7280;
    }

    .review-content {
        font-size: 15px;
        line-height: 1.7;
        color: #374151;
        margin-bottom: 16px;
    }

    .review-helpful {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
        color: #6b7280;
    }

    .helpful-btn {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .helpful-btn:hover {
        background: #eff6ff;
        border-color: #1e3a8a;
    }

    .load-more-reviews {
        text-align: center;
        margin-top: 32px;
    }

    .load-more-reviews button {
        padding: 14px 32px;
        background: white;
        color: #1e3a8a;
        border: 2px solid #1e3a8a;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .load-more-reviews button:hover {
        background: #1e3a8a;
        color: white;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .two-column-layout {
            grid-template-columns: 1fr;
        }

        .visitor-info-grid {
            grid-template-columns: 1fr;
        }

        .nearby-section {
            grid-template-columns: 1fr;
        }

        .similar-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .carousel-container {
            height: 300px;
        }

        .content-container {
            padding: 24px 16px 60px;
        }

        .attraction-header {
            grid-template-columns: 1fr;
        }

        .header-left h1 {
            font-size: 32px;
        }

        .highlights-grid {
            grid-template-columns: 1fr;
        }

        .facilities-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .similar-grid {
            grid-template-columns: 1fr;
        }

        .reviews-summary {
            grid-template-columns: 1fr;
            text-align: center;
        }
    }

    /* Save Button Styles */
    .save-btn {
        padding: 16px;
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 20px;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .save-btn:hover {
        border-color: #dc2626;
        background: #fef2f2;
    }

    .save-btn.saved {
        background: #dc2626;
        border-color: #dc2626;
        color: white;
    }

    .save-btn.saved:hover {
        background: #b91c1c;
    }

    /* Map Button */
    .map-btn {
        padding: 16px 32px;
        background: white;
        color: #1e3a8a;
        border: 2px solid #1e3a8a;
        border-radius: 12px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s;
        text-decoration: none;
        margin-top: 12px;
    }

    .map-btn:hover {
        background: #1e3a8a;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(30, 58, 138, 0.4);
    }

    /* Toast Notification */
    .toast {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #1e3a8a;
        color: white;
        padding: 16px 24px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        display: none;
        align-items: center;
        gap: 12px;
        z-index: 10000;
        animation: slideIn 0.3s ease;
    }

    .toast.show {
        display: flex;
    }

    .toast.success {
        background: #059669;
    }

    .toast.error {
        background: #dc2626;
    }

    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

</style>
@endsection

@section('content')

<!-- Toast Notification -->
<div id="toast" class="toast">
    <span id="toast-icon">✓</span>
    <span id="toast-message">Message</span>
</div>
<!-- Image Carousel -->
<div class="carousel-container">
    <div class="carousel-counter">
        <span id="currentSlide">1</span> / <span>{{ count($attraction->getAllImages()) }}</span>
    </div>

    @foreach($attraction->getAllImages() as $index => $image)
    <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}">
        <img src="{{ $image }}" alt="{{ $attraction->name }} - Image {{ $index + 1 }}">
    </div>
    @endforeach

    <button class="carousel-btn prev" onclick="changeSlide(-1)">‹</button>
    <button class="carousel-btn next" onclick="changeSlide(1)">›</button>

    <div class="carousel-indicators">
        @foreach($attraction->getAllImages() as $index => $image)
        <div class="carousel-indicator {{ $index === 0 ? 'active' : '' }}" onclick="goToSlide({{ $index }})"></div>
        @endforeach
    </div>

    <div class="thumbnail-strip">
        @foreach($attraction->getAllImages() as $index => $image)
        <div class="thumbnail {{ $index === 0 ? 'active' : '' }}" onclick="goToSlide({{ $index }})">
            <img src="{{ $image }}" alt="Thumbnail {{ $index + 1 }}">
        </div>
        @endforeach
    </div>
</div>

<!-- Main Content -->
<div class="content-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span>›</span>
        <a href="{{ route('countries.show', $country->slug) }}">{{ $country->name }}</a>
        <span>›</span>
        <a href="{{ route('countries.districts.show', [$country->slug, $district->slug]) }}">{{ $district->name }}</a>
        <span>›</span>
        <a href="{{ route('countries.districts.categories.index', [$country->slug, $district->slug]) }}">Categories</a>
        <span>›</span>
        <a href="{{ route('countries.districts.categories.attractions', [$country->slug, $district->slug, $category->slug]) }}">{{ $category->name }}</a>
        <span>›</span>
        <span>{{ $attraction->name }}</span>
    </div>

    <!-- Header -->
    <div class="attraction-header">
        <div class="header-left">
            <h1>{{ $attraction->name }}</h1>

           @if($attraction->tags && is_array($attraction->tags) && count($attraction->tags) > 0)
<div class="tags-row">
    @foreach($attraction->tags as $tag)
    <span class="tag {{ Str::contains($tag, 'UNESCO') ? 'unesco' : '' }}">{{ $tag }}</span>
    @endforeach
    @if($attraction->is_featured)
    <span class="tag featured">Featured</span>
    @endif
</div>
@endif

            <div class="meta-row">
                <div class="rating-display">
                    <span class="rating-number">{{ $attraction->getFormattedRating() }}</span>
                    <span class="rating-stars">{{ $attraction->getStarRating() }}</span>
                    <span class="reviews-count">({{ number_format($attraction->reviews_count) }} reviews)</span>
                </div>

                <div class="location-display">
                    <span>📍</span>
                    <span>{{ $attraction->location ?? $attraction->address }}</span>
                </div>
            </div>
        </div>

        <div class="header-right">
            <button class="add-to-trip-btn">
                <span>➕</span>
                <span>Add to My Trip</span>
            </button>

             @if($googleMapsUrl)
            <a href="{{ $googleMapsUrl }}" target="_blank" class="map-btn">
                <span>🗺️</span>
                <span>Get Directions</span>
            </a>
            @endif

            @auth
            <button class="save-btn {{ $isSaved ? 'saved' : '' }}"
                    onclick="toggleSave({{ $attraction->id }})"
                    id="save-btn">
                <span id="save-icon">{{ $isSaved ? '❤️' : '🤍' }}</span>
            </button>
            @else
            <a href="{{ route('login') }}" class="save-btn" title="Login to save">
                <span>🤍</span>
            </a>
            @endauth

            <button class="share-btn" onclick="shareAttraction()">
                🔗
            </button>
        </div>
    </div>

    <!-- About & Quick Facts -->
    <div class="two-column-layout">
        <!-- About -->
        <div class="section-card">
            <h2 class="section-title">📖 About</h2>
            <p class="about-text">{{ $attraction->description }}</p>

            @if($attraction->category->name == 'Temples & Religious Sites' || $attraction->tags)
            <h3 class="section-title" style="font-size: 20px; margin-top: 24px;">✨ Highlights</h3>
            <div class="highlights-grid">
                <div class="highlight-item">
                    <span class="highlight-check">✓</span>
                    <span>Sacred Tooth Relic of Buddha</span>
                </div>
                <div class="highlight-item">
                    <span class="highlight-check">✓</span>
                    <span>UNESCO World Heritage Site</span>
                </div>
                <div class="highlight-item">
                    <span class="highlight-check">✓</span>
                    <span>Traditional Kandyan Architecture</span>
                </div>
                <div class="highlight-item">
                    <span class="highlight-check">✓</span>
                    <span>Daily Puja Ceremonies</span>
                </div>
            </div>
            @endif

            @if($attraction->tags && is_array($attraction->tags) && count($attraction->tags) > 0)
<div style="margin-top: 24px;">
    <h3 class="section-title" style="font-size: 18px; margin-bottom: 12px;">🏷️ Tags</h3>
    <div class="tags-row">
        @foreach($attraction->tags as $tag)
        <span class="tag">{{ $tag }}</span>
        @endforeach
    </div>
</div>
@endif
        </div>

        <!-- Quick Facts & Weather -->
        <div>
            <div class="section-card">
                <h2 class="section-title">⚡ Quick Facts</h2>
                <div class="quick-facts-list">
                    <div class="fact-item">
                        <span class="fact-label">Type:</span>
                        <span class="fact-value">{{ $category->name }}</span>
                    </div>
                    @if($attraction->best_time_to_visit)
                    <div class="fact-item">
                        <span class="fact-label">Established:</span>
                        <span class="fact-value">18th Century</span>
                    </div>
                    @endif
                    <div class="fact-item">
                        <span class="fact-label">Managed by:</span>
                        <span class="fact-value">Diyawadana Nilame</span>
                    </div>
                    @if($attraction->phone)
                    <div class="fact-item">
                        <span class="fact-label">Contact:</span>
                        <span class="fact-value">{{ $attraction->phone }}</span>
                    </div>
                    @endif
                    @if($attraction->website)
                    <div class="fact-item">
                        <span class="fact-label">Website:</span>
                        <a href="{{ $attraction->website }}" target="_blank" class="fact-value" style="color: #1e3a8a;">Visit Official Website</a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Weather Widget -->
            <div class="weather-widget">
                <h3 style="font-size: 18px; margin-bottom: 16px;">🌤️ Weather at Location</h3>
                <div class="weather-icon">{{ $weather['icon'] }}</div>
                <div class="weather-temp">{{ $weather['temperature'] }}°C</div>
                <div class="weather-condition">{{ $weather['condition'] }}</div>
                <div class="weather-details">
                    <div class="weather-detail">
                        <div class="weather-detail-value">{{ $weather['humidity'] }}%</div>
                        <div class="weather-detail-label">Humidity</div>
                    </div>
                    <div class="weather-detail">
                        <div class="weather-detail-value">{{ $weather['wind_speed'] }} km/h</div>
                        <div class="weather-detail-label">Wind Speed</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Visitor Information -->
    <div class="section-card" style="margin-bottom: 48px;">
        <h2 class="section-title">ℹ️ Visitor Information</h2>

        <div class="visitor-info-grid">
            <!-- Opening Hours -->
            <div class="info-box">
                <div class="info-box-title">🕐 Opening Hours</div>
                <div class="hours-table">
                    <div class="hours-row">
                        <span class="day-label">Today (Monday)</span>
                        <span class="time-label">{{ $openingHours['opening'] }} - {{ $openingHours['closing'] }}</span>
                    </div>
                    <div class="hours-row">
                        <span class="day-label">Tuesday - Sunday</span>
                        <span class="time-label">5:30 AM - 8:00 PM</span>
                    </div>
                </div>
                <p class="ceremony-note">*Puja ceremonies: 5:30 AM, 9:30 AM & 6:30 PM</p>
            </div>

            <!-- Entry Fees -->
            <div class="info-box">
                <div class="info-box-title">💰 Entry Fees</div>
                <div class="fee-list">
                    <div class="fee-row">
                        <span class="fee-type">Adults (Local)</span>
                        <span class="fee-amount">LKR {{ number_format($attraction->entry_fee ?? 100) }}</span>
                    </div>
                    <div class="fee-row">
                        <span class="fee-type">Children (Local)</span>
                        <span class="fee-amount">LKR 50</span>
                    </div>
                    <div class="fee-row">
                        <span class="fee-type">Foreign Adults</span>
                        <span class="fee-amount">USD 10</span>
                    </div>
                    <div class="fee-row">
                        <span class="fee-type">Foreign Children</span>
                        <span class="fee-amount">USD 5</span>
                    </div>
                </div>
            </div>

            <!-- Best Time & Duration -->
            <div class="info-box">
                <div class="info-box-title">⏰ Best Time to Visit</div>
                <div class="best-time-content">
                    <p>{{ $attraction->best_time_to_visit ?? 'Early morning (6:00-8:00 AM) or evening (6:00-7:00 PM) for ceremonies' }}</p>
                    <span class="time-badge">Recommended</span>
                </div>

                @if($attraction->duration)
                <div class="duration-box">
                    <span class="duration-icon">⏱️</span>
                    <div>
                        <div style="font-size: 12px; color: #6b7280;">Duration</div>
                        <div class="duration-text">{{ $attraction->duration }}</div>
                    </div>
                </div>
                @endif

                @if($attraction->languages)
                <div style="margin-top: 16px;">
                    <div style="font-size: 14px; color: #6b7280; margin-bottom: 8px; font-weight: 600;">Languages</div>
                    <div class="languages-list">
                        @foreach(explode(',', $attraction->languages) as $language)
                        <span class="language-badge">{{ trim($language) }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Facilities -->
    @if($facilities && count($facilities) > 0)
    <div class="section-card" style="margin-bottom: 48px;">
        <h2 class="section-title">🏢 Facilities</h2>
        <div class="facilities-grid">
            @foreach($facilities as $facility)
            <div class="facility-card">
                <div class="facility-icon">{{ $facility['icon'] }}</div>
                <div class="facility-name">{{ $facility['name'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Nearby Restaurants & Accommodations -->
    <div class="nearby-section">
        <!-- Accommodations -->
        <div class="nearby-card">
            <h2 class="section-title">🏨 Hotels Near This Attraction</h2>
            <div class="nearby-grid">
                @forelse($nearbyAccommodations as $accommodation)
                <a href="#" class="nearby-item">
                    <div class="nearby-image">
                        <img src="{{ $accommodation->image_url }}" alt="{{ $accommodation->name }}">
                    </div>
                    <div class="nearby-info">
                        <h4>{{ $accommodation->name }}</h4>
                        <div class="nearby-meta">
                            <span class="nearby-rating">⭐ {{ number_format($accommodation->rating, 1) }}</span>
                            <span class="nearby-distance">📍 {{ number_format($accommodation->distanceFrom($attraction), 1) }} km away</span>
                        </div>
                        <div style="font-size: 13px; color: #059669; font-weight: 600; margin-top: 4px;">
                            {{ $accommodation->getFormattedPrice() }}
                        </div>
                    </div>
                </a>
                @empty
                <p style="color: #6b7280; font-size: 14px;">No accommodations nearby</p>
                @endforelse
            </div>
            @if($nearbyAccommodations->count() > 0)
            <a href="{{ route('accommodations.near-attraction', [$country->slug, $district->slug, $category->slug, $attraction->slug]) }}" class="view-all-btn">View All Hotels</a>
            @endif
        </div>

        <!-- Restaurants -->
        <div class="nearby-card">
            <h2 class="section-title">🍽️ Restaurants Near This Attraction</h2>
            <div class="nearby-grid">
                @forelse($nearbyRestaurants as $restaurant)
                <a href="#" class="nearby-item">
                    <div class="nearby-image">
                        <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}">
                    </div>
                    <div class="nearby-info">
                        <h4>{{ $restaurant->name }}</h4>
                        <div class="nearby-meta">
                            <span class="nearby-rating">⭐ {{ number_format($restaurant->rating, 1) }}</span>
                            <span class="nearby-distance">📍 {{ number_format($restaurant->distanceFrom($attraction), 1) }} km away</span>
                        </div>
                        @if($restaurant->cuisine_type)
                        <div style="font-size: 13px; color: #6b7280; margin-top: 4px;">
                            {{ is_array($restaurant->cuisine_type) ? implode(', ', $restaurant->cuisine_type) : $restaurant->cuisine_type }} • {{ $restaurant->getFormattedPriceRange() }}
                        </div>
                        @endif
                    </div>
                </a>
                @empty
                <p style="color: #6b7280; font-size: 14px;">No restaurants nearby</p>
                @endforelse
            </div>
           @if($nearbyRestaurants->count() > 0)
<a href="{{ route('restaurants.near-attraction', [$country->slug, $district->slug, $category->slug, $attraction->slug]) }}" class="view-all-btn">View All Restaurants</a>
@endif
        </div>
    </div>

    <!-- You May Also Like -->
    @if($similarAttractions->count() > 0)
    <div class="similar-attractions">
        <h2 class="section-title">💡 You May Also Like</h2>
        <div class="similar-grid">
            @foreach($similarAttractions as $similar)
            <a href="{{ route('attractions.show', [$country->slug, $district->slug, $category->slug, $similar->slug]) }}" class="similar-card">
                <div class="similar-image">
                    <img src="{{ $similar->image_url }}" alt="{{ $similar->name }}">
                </div>
                <div class="similar-content">
                    <h3 class="similar-name">{{ $similar->name }}</h3>
                    <div class="similar-rating">
                        <span>⭐</span>
                        <span>{{ number_format($similar->rating, 1) }}</span>
                    </div>
                    <div class="similar-distance">
                        📍 {{ number_format($similar->distanceFrom($attraction), 1) }} km away
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div style="text-align: center; margin-top: 24px;">
            <a href="{{ route('countries.districts.categories.attractions', [$country->slug, $district->slug, $category->slug]) }}" class="view-all-btn" style="max-width: 300px; margin: 0 auto;">
                View All Attractions
            </a>
        </div>
    </div>
    @endif

    <!-- Reviews & Ratings -->
    <div class="reviews-section">
        <div class="reviews-header">
            <h2 class="section-title">⭐ Reviews & Ratings</h2>
            <button class="write-review-btn">Write a Review</button>
        </div>

        <!-- Reviews Summary -->
        <div class="reviews-summary">
            <div class="overall-rating">
                <div class="overall-number">{{ $attraction->getFormattedRating() }}</div>
                <div class="overall-stars">{{ $attraction->getStarRating() }}</div>
                <div class="overall-count">Based on {{ number_format($attraction->reviews_count) }} reviews</div>
            </div>

            <div class="rating-breakdown">
                @foreach(['5', '4', '3', '2', '1'] as $star)
                <div class="rating-bar-row">
                    <span class="rating-label">{{ $star }}★</span>
                    <div class="rating-bar-container">
                        <div class="rating-bar-fill" style="width: {{ $ratingDistribution[$star] }}%"></div>
                    </div>
                    <span class="rating-percentage">{{ $ratingDistribution[$star] }}%</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Reviews List -->
        <div class="reviews-list">
            @forelse($attraction->reviews as $review)
            <div class="review-card">
                <div class="review-header">
                    <div class="reviewer-info">
                        <div class="reviewer-avatar">
                            @if($review->user_avatar)
                            <img src="{{ $review->user_avatar }}" alt="{{ $review->user_name }}">
                            @else
                            👤
                            @endif
                        </div>
                        <div class="reviewer-details">
                            <h4>{{ $review->user_name }}</h4>
                            <div class="review-meta">
                                <div class="review-rating">
                                    @for($i = 0; $i < 5; $i++)
                                        <span>{{ $i < $review->rating ? '★' : '☆' }}</span>
                                    @endfor
                                </div>
                                <span class="review-date">{{ $review->getTimeAgo() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($review->title)
                <h4 style="font-size: 16px; font-weight: 700; color: #1e3a8a; margin-bottom: 12px;">{{ $review->title }}</h4>
                @endif

                <p class="review-content">{{ $review->comment }}</p>

                <div class="review-helpful">
                    <button class="helpful-btn">
                        <span>👍</span>
                        <span>Helpful ({{ $review->helpful_count }})</span>
                    </button>
                </div>
            </div>
            @empty
            <div style="text-align: center; padding: 40px; color: #6b7280;">
                <p>No reviews yet. Be the first to review!</p>
            </div>
            @endforelse
        </div>

        @if($attraction->reviews_count > 10)
        <div class="load-more-reviews">
            <button>Load More Reviews</button>
        </div>
        @endif
    </div>
</div>

<script>
    // Carousel functionality
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.carousel-indicator');
    const thumbnails = document.querySelectorAll('.thumbnail');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
        indicators.forEach((indicator, i) => {
            indicator.classList.toggle('active', i === index);
        });
        thumbnails.forEach((thumb, i) => {
            thumb.classList.toggle('active', i === index);
        });
        document.getElementById('currentSlide').textContent = index + 1;
    }

    function changeSlide(direction) {
        currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }

    function goToSlide(index) {
        currentSlide = index;
        showSlide(currentSlide);
    }

    // Auto-play carousel
    setInterval(() => {
        changeSlide(1);
    }, 5000);

    @auth
    // CSRF token for AJAX requests
    const csrfToken = '{{ csrf_token() }}';

    // Toggle save/unsave
    async function toggleSave(attractionId) {
        const saveBtn = document.getElementById('save-btn');
        const saveIcon = document.getElementById('save-icon');

        try {
            const response = await fetch('{{ route("saved.toggle") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    type: 'Attraction',
                    id: attractionId
                })
            });

            const data = await response.json();

            if (data.success) {
                if (data.saved) {
                    saveBtn.classList.add('saved');
                    saveIcon.textContent = '❤️';
                    showToast('Added to saved places!', 'success');
                } else {
                    saveBtn.classList.remove('saved');
                    saveIcon.textContent = '🤍';
                    showToast('Removed from saved places', 'success');
                }
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Something went wrong', 'error');
        }
    }
    @endauth


       // Show toast notification
    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');
        const toastIcon = document.getElementById('toast-icon');

        toast.className = 'toast show ' + type;
        toastMessage.textContent = message;
        toastIcon.textContent = type === 'success' ? '✓' : '✗';

        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
    }

    // Share functionality
    function shareAttraction() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $attraction->name }}',
                text: '{{ Str::limit($attraction->description, 100) }}',
                url: window.location.href
            });
        } else {
            // Fallback: copy to clipboard
            navigator.clipboard.writeText(window.location.href);
            alert('Link copied to clipboard!');
        }
    }

    // Add to trip functionality (placeholder)
    document.querySelector('.add-to-trip-btn').addEventListener('click', function() {
        alert('Feature coming soon! You can add this attraction to your personalized trip plan.');
    });

    // Write review button (placeholder)
    document.querySelector('.write-review-btn').addEventListener('click', function() {
        alert('Review form coming soon!');
    });
</script>
@endsection
