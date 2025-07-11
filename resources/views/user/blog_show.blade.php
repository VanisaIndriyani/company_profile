<style>
    .blog-detail-container {
        max-width: 800px;
        margin: 0 auto;
        background: #fffbe6;
        border-radius: 18px;
        box-shadow: 0 2px 16px rgba(111, 78, 55, 0.10);
        padding: 2.5rem 2.5rem 2rem 2.5rem;
    }
    .blog-detail-title {
        color: #6f4e37;
        font-family: 'Montserrat', sans-serif;
        font-weight: 800;
        font-size: 2.2rem;
        letter-spacing: 1px;
        margin-bottom: 12px;
        text-align: center;
    }
    .blog-detail-meta {
        color: #b4845c;
        font-size: 1.05rem;
        margin-bottom: 18px;
        text-align: center;
    }
    .blog-detail-img {
        max-width: 120px;
        max-height: 120px;
        width: 100%;
        height: auto;
        object-fit: cover;
        display: block;
        margin: 0 auto 18px auto;
        border-radius: 14px;
        box-shadow: 0 2px 12px #b4845c22;
    }
    .blog-detail-content {
        color: #4e3a23;
        font-size: 1.15rem;
        line-height: 1.7;
        font-family: 'Montserrat', sans-serif;
        text-align: justify;
    }
</style>
<div class="blog-detail-container">
    <div class="blog-detail-title">{{ $article->title ?? 'Judul Blog' }}</div>
    <div class="blog-detail-meta">
        {{ $article->created_at ? $article->created_at->format('d M Y') : '' }}
    </div>
    @if(!empty($article->image))
        <img src="{{ asset('article_image/'.$article->image) }}" class="blog-detail-img" alt="{{ $article->title }}">
    @endif
    <div class="blog-detail-content">
        {!! nl2br(e($article->content ?? 'Konten blog...')) !!}
    </div>
</div> 