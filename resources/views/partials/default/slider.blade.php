@inject('sliders', 'App\Slider')
@inject('likes', 'App\Likes')

@foreach($sliders->Showm() as $slider)
   <div class="slider__item" style="background: url({{ env('APP_URL') }}{{ $slider->image }}) center no-repeat;" data-source="https://www.youtube.com/embed/{{ $slider->trailer }}" data-id="{{ $slider->movie_id }}">
                  <a href="{{ route('show.movies', ['id' => $slider->movie_id, 'slug' => $slider->slug]) }}" class="slider__link">
                     <div class="slider__description">
                        <div class="slider__description-list">
                           <div class="rating" data-value="{{ $slider->imdb_rating / 10 }}">
                              <span class="rating__number">{{ $slider->imdb_rating }}</span>
                           </div>
                           <div class="trailer__button">
                              <a href="#" class="trailer__link" id="showTrailer"><i class="icon icon-play"></i></a>
                           </div>
                           <div class="favourite__button">
                              @if(\Auth::check())
                                 @if(count($likes->F($slider->movie_id)->first()) > 0)
                                    <a href="#" class="favourite__link" id="cLike"><i class="icon icon-heart icon-heart-full"></i></a>
                                 @else
                                    <a href="#" class="favourite__link" id="cLike"><i class="icon icon-heart"></i></a>
                                 @endif
                              @else
                                 <a href="#" class="favourite__link button-auth"><i class="icon icon-heart"></i></a>
                              @endif
                           </div>
                        </div>

                        <div class="slider__description-info">
                           <h1 class="title">{{ $slider->title }}</h1>
                           <p class="text">{{ str_limit($slider->overview, 149) }}
                           </p>
                        </div>
                     </div>
                  </a>
               </div>
@endforeach