<!-- resources/views/components/title-wrapper.blade.php -->

<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title">
                <h2>{{ $title }}</h2>
            </div>
        </div>
        <!-- end col -->
        <div class="col-md-6">
            <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @foreach($breadcrumbs as $breadcrumb)
                            @if($loop->last)
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $breadcrumb['label'] }}
                                </li>
                            @else
                                <li class="breadcrumb-item">
                                    <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
