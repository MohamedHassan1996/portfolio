@include('Layout.header')
<!-- hero section -->
<section>
    @php
        $data = $aboutPage->sections;
        $ourStorySection = $data->first();
        $ourStorySectionImages = $ourStorySection->images;
        $aboutUsSection = $data->skip(2)->first();
        $aboutUsSectionImages = $aboutUsSection->images;
        $statsSection = $data->skip(1)->first();
    @endphp
<!-- hero section -->
<section>
    @include('Layout.navbar')
</section>
@include('AboutUs.Sections.ourStory', [
    'ourStorySection' => $ourStorySection,
    'ourStorySectionImages' => $ourStorySectionImages,
])
@include('AboutUs.Sections.stats', [
    'statsSection' => $statsSection,
])
@include('AboutUs.Sections.aboutUs', [
    'aboutUsSection' => $aboutUsSection,
    'aboutUsSectionImages' => $aboutUsSectionImages,
])

@include('Layout.footer')
