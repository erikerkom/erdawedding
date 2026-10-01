<?php

use Livewire\Component;
use App\Models\WeddingComment;
use Livewire\WithPagination;

new class extends Component {
    //
     use WithPagination;

    public $name = '';
    public string $presence = 'Hadir'; // Pastikan ada nilai awal default
    public $greeting = '';
    // Variabel penampung Geolocation dari JS
    public ?float $latitude = null;
    public ?float $longitude = null;

    protected array $rules = [
        'name' => 'required|string|max:100',
        'presence' => 'required|in:Hadir,Berhalangan',
        'greeting' => 'required|string|max:1000',
    ];

    public function save()
    {
        // WeddingComment::create(
        //     $this->only(['name', 'presence', 'message', 'ip_address', 'user_agent', 'latitude', 'longitude'])
        // );
        WeddingComment::create([
            'name' => $this->name,
            'presence' => $this->presence,
            'message' => $this->greeting,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'is_published' => true,
        ]);
        
        // Reset input form
        $this->reset(['name', 'message']);
        $this->presence = 'Hadir';
        session()->flash('status', '❤️❤️❤️ Terima Kasih Atas Doa Restunya ❤️❤️❤️');
 
        return $this->redirect('/');

        
    }

    public function render()
    {
        return view('pages.home.⚡index', [
            'comments' => WeddingComment::where('is_published', true)
                ->latest()
                ->paginate(10),
        ]);
    }
};
?>

<div>
    {{-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison --}}
    <!-- Container Partikel Love -->
    <div id="heart-container" class="fixed inset-0 pointer-events-none z-50"></div>

    <!-- Background Audio -->
    <audio id="audio-player" loop
        src="{{ asset('music/lagu-pernikahan-kita.mp3') }}"></audio>

    <!-- Welcome Modal Overlay -->
    <div id="welcome"
        class="fixed inset-0 z-50 flex items-center justify-center bg-stone-100 dark:bg-stone-900 text-stone-800 dark:text-stone-100 transition-opacity duration-700">
        <img src="images/bg-home.jpeg"
            onerror="this.src='https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=1000&auto=format&fit=crop'"
            class="absolute inset-0 w-full h-full object-cover opacity-15 pointer-events-none" alt="Welcome Background">

        <!-- Hiasan Sparkle Emas -->
        <span class="gold-dust" style="left:15%;top:20%;animation-delay:0.2s"></span>
        <span class="gold-dust" style="right:15%;top:25%;animation-delay:1.1s"></span>
        <span class="gold-dust" style="left:20%;bottom:20%;animation-delay:2.4s"></span>

        <!-- Floating Hearts -->
        <i class="fa-solid fa-heart floating-heart text-sm text-brand-500/40"
            style="left:8%;top:40%;animation-delay:0.5s"></i>
        <i class="fa-solid fa-heart floating-heart text-xs text-brand-500/30"
            style="right:10%;top:60%;animation-delay:2s"></i>

        <!-- SVG Ornamen Dayak Corner Kiri Atas -->
        <svg class="absolute top-2 left-2 w-20 h-20 opacity-40 pointer-events-none text-brand-500 fill-current"
            viewBox="0 0 100 100">
            <path
                d="M0 0 V40 C10 40 20 35 20 20 C35 20 40 10 40 0 Z M25 0 C25 15 15 25 0 25 V15 C10 15 15 10 15 0 Z M50 0 C50 25 25 50 0 50 V42 C20 42 42 20 42 0 Z M0 60 C35 60 60 35 60 0 H52 C52 30 30 52 0 52 Z M80 0 C80 45 45 80 0 80 V70 C40 70 70 40 70 0 Z" />
            <circle cx="12" cy="12" r="3" />
            <circle cx="28" cy="28" r="4" />
            <circle cx="48" cy="48" r="5" />
        </svg>

        <!-- SVG Ornamen Dayak Corner Kanan Atas -->
        <svg class="absolute top-2 right-2 w-20 h-20 opacity-40 pointer-events-none text-brand-500 fill-current rotate-90"
            viewBox="0 0 100 100">
            <path
                d="M0 0 V40 C10 40 20 35 20 20 C35 20 40 10 40 0 Z M25 0 C25 15 15 25 0 25 V15 C10 15 15 10 15 0 Z M50 0 C50 25 25 50 0 50 V42 C20 42 42 20 42 0 Z M0 60 C35 60 60 35 60 0 H52 C52 30 30 52 0 52 Z M80 0 C80 45 45 80 0 80 V70 C40 70 70 40 70 0 Z" />
            <circle cx="12" cy="12" r="3" />
            <circle cx="28" cy="28" r="4" />
            <circle cx="48" cy="48" r="5" />
        </svg>

        <div id="welcome-content"
            class="text-center p-6 max-w-sm w-full mx-auto flex flex-col items-center relative z-10">
            <div
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-brand-500/30 bg-brand-500/10 text-brand-500 text-[10px] uppercase tracking-widest mb-4">
                <i class="fa-solid fa-gem text-xs"></i> Undangan Pernikahan <i class="fa-solid fa-gem text-xs"></i>
            </div>

            <div class="relative group mb-6 flex items-center justify-center">
                <div class="ring-decor ring-spin !w-36 !h-36 border-brand-500/60"></div>
                <img src="images/1.jpeg"
                    onerror="this.src='https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400&auto=format&fit=crop'"
                    alt="Cover Mempelai"
                    class="w-32 h-32 rounded-full object-cover border-4 border-brand-500 shadow-2xl relative z-10">
            </div>

            <h1 class="font-esthetic text-5xl text-brand-500 mb-2">Erik &amp; Darsini</h1>

            <div class="flex items-center justify-center gap-2 text-brand-500/80 mb-4 text-sm">
                <i class="fa-solid fa-ring"></i>
                <span class="text-xs tracking-widest uppercase font-semibold text-stone-500 dark:text-stone-400">10 . 10
                    . 2026</span>
                <i class="fa-solid fa-ring"></i>
            </div>

            <p class="text-xs text-stone-500 dark:text-stone-400 mb-6">Kepada Yth. Bapak/Ibu/Saudara/i</p>

            <button id="btn-open-invitation" onclick="openInvitation()"
                class="relative group inline-flex items-center gap-2.5 bg-brand-800 hover:bg-brand-900 text-white dark:bg-brand-500 dark:hover:bg-brand-800 font-medium py-3 px-7 rounded-full shadow-lg hover:shadow-2xl hover:shadow-brand-500/50 transform hover:scale-105 cursor-pointer border border-brand-900/10 dark:border-white/20">
                <i class="fa-solid fa-envelope-open text-white transition-transform group-hover:rotate-12"></i>
                <span>Buka Undangan</span>
            </button>

        </div>
    </div>

    <!-- Main Container Layout -->
    <div id="root"
        class="opacity-0 transition-opacity duration-700 min-h-screen max-w-7xl mx-auto flex flex-col lg:flex-row shadow-2xl relative">
        <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden" aria-hidden="true">
            <span class="gold-dust" style="left:8%;top:18%;animation-delay:.3s"></span>
            <span class="gold-dust" style="left:91%;top:31%;animation-delay:1.5s"></span>
            <span class="gold-dust" style="left:13%;top:62%;animation-delay:2.2s"></span>
            <span class="gold-dust" style="left:84%;top:76%;animation-delay:3.1s"></span>
            <i class="fa-solid fa-heart floating-heart text-xs" style="left:10%;top:43%;animation-delay:1s"></i>
            <i class="fa-solid fa-heart floating-heart text-[10px]" style="right:9%;top:58%;animation-delay:3s"></i>
        </div>

        <!-- Desktop Sidebar Banner (Sticky Left Side) -->
        <div
            class="hidden lg:flex lg:w-1/2 xl:w-3/5 h-screen sticky top-0 bg-stone-200 dark:bg-stone-900 relative items-center justify-center overflow-hidden border-r border-stone-300 dark:border-stone-800">
            <img src="images/1.jpeg"
                onerror="this.src='https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=1200&auto=format&fit=crop'"
                class="absolute inset-0 w-full h-full object-cover opacity-40 dark:opacity-25 mix-blend-overlay scale-105"
                alt="Banner Desktop">

            <svg class="absolute top-4 left-4 w-28 h-28 opacity-30 pointer-events-none text-brand-500 fill-current"
                viewBox="0 0 100 100">
                <path
                    d="M0 0 V40 C10 40 20 35 20 20 C35 20 40 10 40 0 Z M25 0 C25 15 15 25 0 25 V15 C10 15 15 10 15 0 Z M50 0 C50 25 25 50 0 50 V42 C20 42 42 20 42 0 Z M0 60 C35 60 60 35 60 0 H52 C52 30 30 52 0 52 Z M80 0 C80 45 45 80 0 80 V70 C40 70 70 40 70 0 Z" />
                <circle cx="12" cy="12" r="3" />
                <circle cx="28" cy="28" r="4" />
                <circle cx="48" cy="48" r="5" />
            </svg>

            <svg class="absolute bottom-4 right-4 w-28 h-28 opacity-30 pointer-events-none text-brand-500 fill-current rotate-180"
                viewBox="0 0 100 100">
                <path
                    d="M0 0 V40 C10 40 20 35 20 20 C35 20 40 10 40 0 Z M25 0 C25 15 15 25 0 25 V15 C10 15 15 10 15 0 Z M50 0 C50 25 25 50 0 50 V42 C20 42 42 20 42 0 Z M0 60 C35 60 60 35 60 0 H52 C52 30 30 52 0 52 Z M80 0 C80 45 45 80 0 80 V70 C40 70 70 40 70 0 Z" />
                <circle cx="12" cy="12" r="3" />
                <circle cx="28" cy="28" r="4" />
                <circle cx="48" cy="48" r="5" />
            </svg>

            <div
                class="relative z-10 text-center p-8 bg-stone-100/80 dark:bg-stone-900/80 backdrop-blur-md rounded-2xl border border-stone-300 dark:border-stone-800 max-w-md mx-4 shadow-2xl">
                <p class="uppercase tracking-widest text-xs text-brand-500 mb-2">Undangan Pernikahan</p>
                <h2 class="font-esthetic text-6xl text-brand-500 mb-4">Erik &amp; Darsini</h2>
                <p class="text-stone-700 dark:text-stone-300 font-light">Sabtu, 10 Oktober 2026</p>
            </div>
        </div>

        <!-- Smartphone / Main Content Container Right Side -->
        <div
            class="w-full lg:w-1/2 xl:w-2/5 min-h-screen bg-stone-50 dark:bg-stone-900 text-stone-800 dark:text-stone-200 relative pb-20 overflow-hidden">

            <svg class="absolute top-2 right-2 w-16 h-16 opacity-20 pointer-events-none z-20 text-brand-500 fill-current rotate-90"
                viewBox="0 0 100 100">
                <path
                    d="M0 0 V40 C10 40 20 35 20 20 C35 20 40 10 40 0 Z M25 0 C25 15 15 25 0 25 V15 C10 15 15 10 15 0 Z M50 0 C50 25 25 50 0 50 V42 C20 42 42 20 42 0 Z M0 60 C35 60 60 35 60 0 H52 C52 30 30 52 0 52 Z M80 0 C80 45 45 80 0 80 V70 C40 70 70 40 70 0 Z" />
                <circle cx="12" cy="12" r="3" />
                <circle cx="28" cy="28" r="4" />
                <circle cx="48" cy="48" r="5" />
            </svg>

            <!-- Home Section -->
            <section id="home"
                class="motion-section reveal-motion relative border-b border-stone-300 dark:border-stone-800">
                <div class="ring-decor ring-spin" style="top:11%;right:10%;opacity:.45"></div>
                <div class="ring-decor" style="bottom:13%;left:8%;width:62px;height:62px;opacity:.35"></div>

                <div class="min-h-screen flex flex-col items-center justify-center text-center p-6 relative">
                    <div class="absolute inset-0 z-0 overflow-hidden">
                        <img src="images/bg-home.jpeg"
                            onerror="this.src='https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=800&auto=format&fit=crop'"
                            alt="Hero BG"
                            class="w-full h-full object-cover opacity-20 dark:opacity-10 transition-all duration-500">
                    </div>

                    <div class="relative z-10 flex flex-col items-center max-w-xs">
                        <span class="section-kicker mb-3">Together in faith</span>
                        <p class="text-xs uppercase tracking-widest text-brand-500 mb-4">Pemberkatan &amp; Resepsi
                            Pernikahan</p>

                        <div class="relative my-4">
                            <img src="{{ asset('images/mempelai-gandeng.jpeg') }}"
                                onerror="this.src='https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=300&auto=format&fit=crop'"
                                alt="Mempelai Utama"
                                class="w-36 h-36 rounded-full object-cover border-4 border-brand-500/80 shadow-2xl">
                        </div>

                        <h1 class="font-esthetic text-5xl text-brand-500 my-2">Erik &amp; Darsini</h1>
                        <p class="text-sm font-light text-stone-600 dark:text-stone-400 mb-6">Sabtu, 10 Oktober 2026
                        </p>

                        <a href="https://calendar.google.com" target="_blank"
                            class="inline-flex items-center gap-2 border border-brand-500 text-brand-500 hover:bg-brand-500 hover:text-white px-4 py-2 rounded-full text-xs transition duration-300">
                            <i class="fa-solid fa-calendar-check"></i> Simpan Tanggal
                        </a>

                        <div
                            class="mt-12 flex flex-col items-center text-stone-400 dark:text-stone-500 text-xs animate-bounce">
                            <i class="fa-solid fa-chevron-down mb-1"></i>
                            <span>Gulir Ke Bawah</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Mempelai / Bride Section -->
            <section id="bride"
                class="motion-section reveal-motion py-16 px-6 text-center border-b border-stone-300 dark:border-stone-800 bg-stone-100/50 dark:bg-stone-900/30 relative"
                x-data="intersectSection">
                <img src="{{ asset ('images/bunga-kiri.webp') }}" x-show="show"
                    x-transition:enter="transition ease-in-out duration-1000 delay-300"
                    x-transition:enter-start="opacity-0 -translate-x-12"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="absolute left-0 top-[60%] w-28 sm:w-24 pointer-events-none z-0 opacity-70 animate-float-slow"
                    alt="Bunga Kiri">
                <img src="{{ asset('images/bunga-kanan.webp') }}" x-show="show"
                    x-transition:enter="transition ease-in-out duration-1000 delay-500"
                    x-transition:enter-start="opacity-0 translate-x-12"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="absolute right-0 top-[60%] w-28 sm:w-24 pointer-events-none z-0 opacity-70 animate-float-slow"
                    alt="Bunga Kanan">

                <div class="flex justify-center items-center gap-2 mb-6 opacity-60" x-intersect.once="triggerShow">
                    <div class="h-[1px] w-12 bg-stone-400 dark:bg-stone-600"></div>
                    <img src="{{ asset('images/hai.png') }}" onerror="this.style.display='none'" alt="Ornamen"
                        class="h-24 object-contain">
                    <div class="h-[1px] w-12 bg-stone-400 dark:bg-stone-600"></div>
                </div>

                <div class="wedding-seal mx-auto mb-4"><i class="fa-solid fa-ring text-xl"></i></div>
                <span class="section-kicker mb-2">The bride & groom</span>
                <h2 class="font-esthetic text-4xl text-brand-500 mb-2">Kami Yang Berbahagia</h2>
                <p class="text-xs text-stone-500 dark:text-stone-400 italic mb-10 px-4">"Demikianlah mereka bukan lagi
                    dua, melainkan satu. Karena itu, apa yang telah dipersatukan Allah, tidak boleh diceraikan manusia."
                </p>

                <!-- Pria -->
                <div class="mb-10 flex flex-col items-center relative z-10">
                    <div class="relative mb-4">
                        <img src="{{ asset('images/Erik2.jpg') }}"
                            onerror="this.src='https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=300&auto=format&fit=crop'"
                            class="w-32 h-32 rounded-full object-cover border-2 border-brand-500 shadow-lg"
                            alt="Pria">
                    </div>
                    <h3 class="font-esthetic text-4xl text-brand-500">Nobertus Erik</h3>
                    <p class="text-xs text-brand-500/80 mt-1 mb-1 font-semibold">Putra Pertama dari</p>
                    <p class="text-xs text-stone-700 dark:text-stone-300">Bapak Hilarius Rajii &amp; Ibu Rufina</p>
                    <p class="text-[11px] text-stone-500 dark:text-stone-400 mt-0.5">Paroki St. Fidelis Sigmaringen,
                        Sejiram, Keuskupan Sintang</p>
                </div>

                <div class="font-esthetic text-5xl text-brand-500 my-4">&amp;</div>

                <!-- Wanita -->
                <div class="mt-8 flex flex-col items-center relative z-10">
                    <div class="relative mb-4">
                        <img src="{{ asset('images/Odek2.jpg') }}"
                            onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=300&auto=format&fit=crop'"
                            class="w-32 h-32 rounded-full object-cover border-2 border-brand-500 shadow-lg"
                            alt="Wanita">
                    </div>
                    <h3 class="font-esthetic text-4xl text-brand-500">Darsini</h3>
                    <p class="text-xs text-brand-500/80 mt-1 mb-1 font-semibold">Putri ke Enam dari</p>
                    <p class="text-xs text-stone-700 dark:text-stone-300">Bapak Sadit &amp; Ibu Salan</p>
                    <p class="text-[11px] text-stone-500 dark:text-stone-400 mt-0.5">Paroki Keluarga Kudus, Kotabaru,
                        Keuskupan Agung Pontianak</p>
                </div>

                <div class="flex justify-center items-center gap-2 mt-10 opacity-60">
                    <div class="h-[1px] w-12 bg-stone-400 dark:bg-stone-600"></div>
                    <img src="{{ asset('images/bunga-tengah.png') }}" onerror="this.style.display='none'" alt="Ornamen"
                        class="h-16 object-contain">
                    <div class="h-[1px] w-12 bg-stone-400 dark:bg-stone-600"></div>
                </div>
            </section>

            <!-- Ayat Alkitab Section -->
            <section
                class="motion-section reveal-motion py-12 px-6 text-center border-b border-stone-300 dark:border-stone-800">
                <div
                    class="bg-white/80 dark:bg-stone-950/60 p-6 rounded-2xl border border-stone-200 dark:border-stone-800/80 shadow-sm max-w-sm mx-auto relative overflow-hidden">
                    <p class="text-xs leading-relaxed text-stone-700 dark:text-stone-300 italic mb-3">
                        "Demikianlah mereka bukan lagi dua, melainkan satu. Karena itu, apa yang telah dipersatukan
                        Allah, tidak boleh diceraikan manusia."
                    </p>
                    <span class="text-xs text-brand-500 font-semibold"> — Matius 19:6</span>
                </div>
            </section>

            <!-- Story of Love Section -->
            <section id="story"
                class="motion-section reveal-motion py-16 px-6 border-b border-stone-300 dark:border-stone-800 bg-stone-100/30 dark:bg-stone-900/10 relative"
                x-data="intersectSection">
                <img src="{{ asset ('images/bunga-kiri.webp') }}" x-show="show"
                    x-transition:enter="transition ease-out duration-1000 delay-300"
                    x-transition:enter-start="opacity-0 -translate-x-12"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-16 sm:w-24 pointer-events-none z-10 opacity-70 animate-float-slow"
                    alt="Bunga Kiri">
                <img src="{{ asset('images/bunga-kanan.webp') }}" x-show="show"
                    x-transition:enter="transition ease-out duration-1000 delay-500"
                    x-transition:enter-start="opacity-0 translate-x-12"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="absolute right-0 top-1/2 -translate-y-1/2 w-16 sm:w-24 pointer-events-none z-10 opacity-70 animate-float-slow"
                    alt="Bunga Kanan">

                <div class="text-center mb-6" x-intersect.once="triggerShow">
                    <span class="section-kicker mb-2">Our journey</span>
                    <h2 class="font-esthetic text-4xl text-brand-500 mb-1">Story of Love</h2>
                    <p class="text-xs text-stone-500 dark:text-stone-400">Kisah Perjalanan Cinta Kami</p>
                </div>

                <div
                    class="max-w-xs mx-auto bg-white/80 dark:bg-stone-950/70 p-5 rounded-2xl border border-stone-200 dark:border-stone-800 shadow-md relative overflow-hidden">
                    <div id="story-content"
                        class="max-h-60 overflow-y-auto pr-2 filter blur-md select-none transition-all duration-700 space-y-6 border-l-2 border-brand-500/30 ml-2 pl-4 text-left">
                        <div class="relative">
                            <div class="absolute -left-[21px] top-1.5 w-2.5 h-2.5 bg-brand-500 rounded-full"></div>
                            <span class="text-[10px] font-semibold text-brand-500 tracking-wider uppercase">Pertama
                                Bertemu</span>
                            <h4 class="text-xs font-bold text-stone-800 dark:text-stone-200 mt-0.5">Tahun 2016</h4>
                            <p class="text-xs text-stone-600 dark:text-stone-400 mt-1 leading-relaxed">
                                Tahun 2016 menjadi awal kami mengenal satu sama lain. Pertemuan kami tidak sengaja dalam kehidupan mahasiswa kampus, yang kemudian menjadi awal dari perjalanan cinta kami. Kami mulai saling mengenal dan berbagi cerita, membangun fondasi yang kuat untuk hubungan kami.
                            </p>
                        </div>

                        <div class="relative">
                            <div class="absolute -left-[21px] top-1.5 w-2.5 h-2.5 bg-brand-500 rounded-full"></div>
                            <span
                                class="text-[10px] font-semibold text-brand-500 tracking-wider uppercase">Berpacaran</span>
                            <h4 class="text-xs font-bold text-stone-800 dark:text-stone-200 mt-0.5">Tahun 2017</h4>
                            <p class="text-xs text-stone-600 dark:text-stone-400 mt-1 leading-relaxed">Setelah saling
                                mengenal lebih dekat dan memahami satu sama lain, kami memutuskan untuk berpacaran. 
                            </p>
                        </div>
                        <div class="relative">
                            <div class="absolute -left-[21px] top-1.5 w-2.5 h-2.5 bg-brand-500 rounded-full"></div>
                            <span
                                class="text-[10px] font-semibold text-brand-500 tracking-wider uppercase">Semakin Mengenal</span>
                            <h4 class="text-xs font-bold text-stone-800 dark:text-stone-200 mt-0.5">2017 - 2026</h4>
                            <p class="text-xs text-stone-600 dark:text-stone-400 mt-1 leading-relaxed">
                                Kami Semakin mengenal satu sama lain, berbagi suka dan duka, serta membangun kepercayaan yang mendalam. Perjalanan ini memperkuat ikatan kami dan membuat kami semakin yakin untuk melangkah ke jenjang yang lebih serius. Kami mengenal satu sama lain dalam kurun waktu kurang lebih 9 tahun, dan selama itu kami belajar banyak tentang kasih sayang, kesabaran, dan pengertian.
                            </p>
                        </div>

                        <div class="relative">
                            <div class="absolute -left-[21px] top-1.5 w-2.5 h-2.5 bg-brand-500 rounded-full"></div>
                            <span class="text-[10px] font-semibold text-brand-500 tracking-wider uppercase">Melangkah
                                ke Jenjang Suci</span>
                            <h4 class="text-xs font-bold text-stone-800 dark:text-stone-200 mt-0.5">Tahun 2026</h4>
                            <p class="text-xs text-stone-600 dark:text-stone-400 mt-1 leading-relaxed">Dengan bimbingan
                                Tuhan dan restu kedua orang tua, kami mantap melangkah memasuki Sakramen Pernikahan yang
                                kudus di hadapan altar gereja.</p>
                        </div>
                    </div>

                    <div id="story-overlay"
                        class="absolute inset-0 bg-stone-900/10 dark:bg-black/40 backdrop-blur-xs flex items-center justify-center p-4 transition-opacity duration-500">
                        <button onclick="revealStory()"
                            class="bg-brand-500 hover:bg-brand-800 text-white font-medium text-xs py-2 px-5 rounded-full shadow-lg transition transform hover:scale-105 flex items-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-book-open"></i> Baca Selengkapnya
                        </button>
                    </div>
                </div>
            </section>

            <!-- Countdown / Acara Section -->
            <section id="wedding-date"
                class="motion-section reveal-motion py-16 px-6 text-center border-b border-stone-300 dark:border-stone-800 bg-stone-100/30 dark:bg-stone-900/20 relative"
                x-data="intersectSection">
                <img src="{{ asset ('images/bunga-kiri.webp') }}" x-show="show"
                    x-transition:enter="transition ease-out duration-1000 delay-300"
                    x-transition:enter-start="opacity-0 -translate-x-12"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-16 sm:w-24 pointer-events-none z-10 opacity-70 animate-float-slow"
                    alt="Bunga Kiri">
                <img src="{{ asset('images/bunga-kanan.webp') }}" x-show="show"
                    x-transition:enter="transition ease-out duration-1000 delay-500"
                    x-transition:enter-start="opacity-0 translate-x-12"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="absolute right-0 top-1/2 -translate-y-1/2 w-16 sm:w-24 pointer-events-none z-10 opacity-70 animate-float-slow"
                    alt="Bunga Kanan">

                <div class="flex justify-center items-center gap-2 mb-6 opacity-60" x-intersect.once="triggerShow">
                    <div class="h-[1px] w-12 bg-stone-400 dark:bg-stone-600"></div>
                    <img src="images/merpati.png" onerror="this.style.display='none'" alt="Ornamen"
                        class="h-16 object-contain">
                    <div class="h-[1px] w-12 bg-stone-400 dark:bg-stone-600"></div>
                </div>

                <span class="section-kicker mb-2">Save the date</span>
                <h2 class="font-esthetic text-4xl text-brand-500 mb-6">Momen Bahagia</h2>

                <div class="grid grid-cols-4 gap-2 max-w-xs mx-auto mb-10">
                    <div
                        class="countdown-tile bg-white dark:bg-stone-950 p-3 rounded-xl border border-stone-200 dark:border-stone-800 shadow-sm">
                        <span id="days" class="block text-xl font-bold text-brand-500">0</span>
                        <span class="text-[10px] text-stone-500 dark:text-stone-400 uppercase">Hari</span>
                    </div>
                    <div
                        class="countdown-tile bg-white dark:bg-stone-950 p-3 rounded-xl border border-stone-200 dark:border-stone-800 shadow-sm">
                        <span id="hours" class="block text-xl font-bold text-brand-500">0</span>
                        <span class="text-[10px] text-stone-500 dark:text-stone-400 uppercase">Jam</span>
                    </div>
                    <div
                        class="countdown-tile bg-white dark:bg-stone-950 p-3 rounded-xl border border-stone-200 dark:border-stone-800 shadow-sm">
                        <span id="minutes" class="block text-xl font-bold text-brand-500">0</span>
                        <span class="text-[10px] text-stone-500 dark:text-stone-400 uppercase">Menit</span>
                    </div>
                    <div
                        class="countdown-tile bg-white dark:bg-stone-950 p-3 rounded-xl border border-stone-200 dark:border-stone-800 shadow-sm">
                        <span id="seconds" class="block text-xl font-bold text-brand-500">0</span>
                        <span class="text-[10px] text-stone-500 dark:text-stone-400 uppercase">Detik</span>
                    </div>
                </div>

                <div class="space-y-6 max-w-xs mx-auto">
                    <div
                        class="motion-card bg-white/80 dark:bg-stone-950/80 p-5 rounded-2xl border border-stone-200 dark:border-stone-800 shadow-sm">
                        <div class="event-icon"><i class="fa-solid fa-church"></i></div>
                        <h3 class="font-esthetic text-3xl text-brand-500 mb-1">Sakramen Perkawinan</h3>
                        <p class="text-xs text-stone-700 dark:text-stone-300">Pukul 13.00 WIB - Selesai</p>
                        <p class="text-[11px] text-stone-500 dark:text-stone-400 mt-2">Gereja Katolik Paroki Keluarga
                            Kudus, Kotabaru, Pontianak</p>
                    </div>
                    <div
                        class="motion-card bg-white/80 dark:bg-stone-950/80 p-5 rounded-2xl border border-stone-200 dark:border-stone-800 shadow-sm">
                        <div class="event-icon"><i class="fa-solid fa-champagne-glasses"></i></div>
                        <h3 class="font-esthetic text-3xl text-brand-500 mb-1">Resepsi Pernikahan</h3>
                        <p class="text-xs text-stone-700 dark:text-stone-300">Pukul 15.00 WIB - 18.00 WIB</p>
                        <p class="text-[11px] text-stone-500 dark:text-stone-400 mt-2">TOSS Cafe & Eatery, Teuku Umar,
                            Pontianak</p>
                    </div>
                </div>

                <div class="mt-8 text-xs text-stone-500 dark:text-stone-400 max-w-xs mx-auto">
                    <p class="mb-4">TOSS Cafe & Eatery, Jln. Teuku Umar, Pontianak</p>
                    <a href="https://maps.app.goo.gl/P6tSzgSH8f3sfcoL9" target="_blank"
                        class="inline-flex items-center gap-2 bg-stone-200 dark:bg-stone-800 hover:bg-stone-300 dark:hover:bg-stone-700 text-stone-800 dark:text-stone-200 px-4 py-2 rounded-full border border-stone-300 dark:border-stone-700 transition">
                        <i class="fa-solid fa-map-location-dot text-brand-500"></i> Buka Google Maps
                    </a>
                </div>
            </section>

            <!-- Galeri Section -->
            <section id="gallery"
                class="motion-section reveal-motion py-16 px-6 text-center border-b border-stone-300 dark:border-stone-800 relative"
                x-data="intersectSection">
                <img src="{{ asset ('images/bunga-kiri.webp') }}" x-show="show"
                    x-transition:enter="transition ease-out duration-1000 delay-300"
                    x-transition:enter-start="opacity-0 -translate-x-12"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-16 sm:w-24 pointer-events-none z-10 opacity-70 animate-float-slow"
                    alt="Bunga Kiri">
                <img src="{{ asset('images/bunga-kanan.webp') }}" x-show="show"
                    x-transition:enter="transition ease-out duration-1000 delay-500"
                    x-transition:enter-start="opacity-0 translate-x-12"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="absolute right-0 top-1/2 -translate-y-1/2 w-16 sm:w-24 pointer-events-none z-10 opacity-70 animate-float-slow"
                    alt="Bunga Kanan">

                <span class="section-kicker mb-2" x-intersect.once="triggerShow">Captured moments</span>
                <h2 class="font-esthetic text-4xl text-brand-500 mb-8">Galeri Foto</h2>
                <div class="grid grid-cols-2 gap-3 max-w-sm mx-auto">
                    <img src="{{ asset('images/2.jpg') }}"
                        onerror="this.src='https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400&auto=format&fit=crop'"
                        alt="Gallery 1"
                        class="gallery-item rounded-xl object-cover w-full h-40 shadow-md hover:opacity-90 transition cursor-pointer"
                        onclick="openModal(this.src)">
                    <img src="{{ asset('images/3.jpg') }}"
                        onerror="this.src='https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=400&auto=format&fit=crop'"
                        alt="Gallery 2"
                        class="gallery-item rounded-xl object-cover w-full h-40 shadow-md hover:opacity-90 transition cursor-pointer"
                        onclick="openModal(this.src)">
                    <img src="{{ asset('images/4.jpg') }}"
                        onerror="this.src='https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400&auto=format&fit=crop'"
                        alt="Gallery 3"
                        class="gallery-item rounded-xl object-cover w-full h-40 shadow-md hover:opacity-90 transition cursor-pointer"
                        onclick="openModal(this.src)">
                    <img src="{{ asset('images/5.jpg') }}"
                        onerror="this.src='https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400&auto=format&fit=crop'"
                        alt="Gallery 4"
                        class="gallery-item rounded-xl object-cover w-full h-40 shadow-md hover:opacity-90 transition cursor-pointer"
                        onclick="openModal(this.src)">
                </div>
            </section>

            <!-- Love Gift Section -->
            <section
                class="motion-section reveal-motion py-16 px-6 text-center border-b border-stone-300 dark:border-stone-800 bg-stone-100/40 dark:bg-stone-900/20">
                <div class="wedding-seal mx-auto mb-4"><i class="fa-solid fa-gift text-xl"></i></div>
                <span class="section-kicker mb-2">A little kindness</span>
                <h2 class="font-esthetic text-4xl text-brand-500 mb-2">Tanda Kasih</h2>
                <p class="text-xs text-stone-500 dark:text-stone-400 mb-8 max-w-xs mx-auto">Doa restu Anda merupakan
                    hadiah terindah bagi kami. Namun jika ingin memberikan tanda kasih, dapat melalui rekening berikut:
                </p>

                <div class="space-y-4 max-w-xs mx-auto text-left">
                    <div
                        class="motion-card bg-white dark:bg-stone-950 p-4 rounded-xl border border-stone-200 dark:border-stone-800 shadow-sm">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs font-bold text-stone-800 dark:text-stone-200">Bank Central Asia
                                (BCA)</span>
                            <i class="fa-solid fa-credit-card text-brand-500"></i>
                        </div>
                        <p class="text-xs text-stone-500 dark:text-stone-400">a.n. Nobertus Erik</p>
                        <div
                            class="flex justify-between items-center mt-3 pt-2 border-t border-stone-100 dark:border-stone-800">
                            <span id="rekening-bca"
                                class="text-sm font-mono tracking-wider text-brand-500">3470377380</span>
                            <button onclick="copyToClipboard('1234567891234', this)"
                                class="text-xs bg-stone-100 dark:bg-stone-800 hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-700 dark:text-stone-300 px-3 py-1 rounded-md transition cursor-pointer">
                                <i class="fa-solid fa-copy"></i> Copy
                            </button>
                        </div>
                    </div>
                    <div
                        class="motion-card bg-white dark:bg-stone-950 p-4 rounded-xl border border-stone-200 dark:border-stone-800 shadow-sm">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs font-bold text-stone-800 dark:text-stone-200">Bank Rakyat Indonesia (BRI)
                            </span>
                            <i class="fa-solid fa-credit-card text-brand-500"></i>
                        </div>
                        <p class="text-xs text-stone-500 dark:text-stone-400">a.n. Nobertus Erik</p>
                        <div
                            class="flex justify-between items-center mt-3 pt-2 border-t border-stone-100 dark:border-stone-800">
                            <span id="rekening-bca"
                                class="text-sm font-mono tracking-wider text-brand-500">483101014564534</span>
                            <button onclick="copyToClipboard('1234567891234', this)"
                                class="text-xs bg-stone-100 dark:bg-stone-800 hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-700 dark:text-stone-300 px-3 py-1 rounded-md transition cursor-pointer">
                                <i class="fa-solid fa-copy"></i> Copy
                            </button>
                        </div>
                    </div>
                    <div
                        class="motion-card bg-white dark:bg-stone-950 p-4 rounded-xl border border-stone-200 dark:border-stone-800 shadow-sm">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs font-bold text-stone-800 dark:text-stone-200">Bank Mandiri</span>
                            <i class="fa-solid fa-credit-card text-brand-500"></i>
                        </div>
                        <p class="text-xs text-stone-500 dark:text-stone-400">a.n. Darsini</p>
                        <div
                            class="flex justify-between items-center mt-3 pt-2 border-t border-stone-100 dark:border-stone-800">
                            <span id="rekening-bca"
                                class="text-sm font-mono tracking-wider text-brand-500">1460006708643</span>
                            <button onclick="copyToClipboard('1234567891234', this)"
                                class="text-xs bg-stone-100 dark:bg-stone-800 hover:bg-stone-200 dark:hover:bg-stone-700 text-stone-700 dark:text-stone-300 px-3 py-1 rounded-md transition cursor-pointer">
                                <i class="fa-solid fa-copy"></i> Copy
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Ucapan & Doa Section -->
            <section id="comment"
                class="motion-section reveal-motion py-16 px-6 text-center border-b border-stone-300 dark:border-stone-800">
                <span class="section-kicker mb-2">Blessing from you</span>
                <h2 class="font-esthetic text-4xl text-brand-500 mb-6">Ucapan &amp; Doa Restu</h2>
                <div x-data="{
                        init() {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(
                                    (position) => {
                                        $wire.latitude = position.coords.latitude;
                                        $wire.longitude = position.coords.longitude;
                                    },
                                    (error) => {
                                        console.warn('Geolocation tidak diizinkan atau tidak tersedia.');
                                    }
                                );
                            }
                        }
                    }">
                    <!-- Alert Status -->
                    @if (session('status'))
                        <div class="max-w-xs mx-auto mb-4 p-3 bg-emerald-100 dark:bg-emerald-950/50 border border-emerald-300 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 text-xs rounded-xl text-center font-medium shadow-sm">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form onsubmit="handleCommentSubmit(event)" wire:submit="save"
                        class="motion-card max-w-xs mx-auto text-left space-y-3 mb-8 bg-white dark:bg-stone-950 p-4 rounded-2xl border border-stone-200 dark:border-stone-800 shadow-sm">
                        <div>
                            <label class="block text-[11px] text-stone-500 dark:text-stone-400 mb-1">Nama Anda</label>
                            <input type="text" id="form-name" wire:model="name" required placeholder="Isikan Nama Anda"
                                class="w-full bg-stone-50 dark:bg-stone-900 border border-stone-300 dark:border-stone-700 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-brand-500 text-stone-800 dark:text-stone-200">
                                @error('name') <span class="text-rose-500 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-[11px] text-stone-500 dark:text-stone-400 mb-1">Konfirmasi
                                Kehadiran</label>
                            <select id="form-presence" wire:model="presence"
                                class="w-full bg-stone-50 dark:bg-stone-900 border border-stone-300 dark:border-stone-700 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-brand-500 text-stone-800 dark:text-stone-200">
                                <option value="Hadir">✅ Hadir</option>
                                <option value="Berhalangan">❌ Berhalangan</option>
                            </select>
                            @error('presence') <span class="text-rose-500 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-[11px] text-stone-500 dark:text-stone-400 mb-1">Ucapan &amp;
                                Doa</label>
                            <textarea id="form-message" wire:model="greeting" rows="3" required placeholder="Tuliskan doa restu untuk kedua mempelai..."
                                class="w-full bg-stone-50 dark:bg-stone-900 border border-stone-300 dark:border-stone-700 rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-brand-500 text-stone-800 dark:text-stone-200">
                            </textarea>
                            @error('greeting') <span class="text-rose-500 text-[10px] mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" wire:loading.attr="disabled"
                            class="w-full bg-brand-500 hover:bg-brand-800 text-white font-medium py-2 rounded-lg text-xs transition duration-300 cursor-pointer disabled:opacity-50 flex items-center justify-center">
                            <span wire:loading.remove>
                                <i class="fa-solid fa-paper-plane mr-1"></i> Kirim Ucapan
                            </span>
                            <span wire:loading>
                                <i class="fa-solid fa-spinner fa-spin mr-1"></i> Mengirim...
                            </span>
                        </button>
                    </form>

                    <!-- Daftar Ucapan Tersimpan -->
                    <div class="max-w-xs mx-auto space-y-3">
                        <h3 class="text-xs font-semibold text-stone-700 dark:text-stone-300 mb-2">
                            Ucapan & Doa ({{ $comments->total() }})
                        </h3>

                        @forelse ($comments as $comment)
                            <div class="bg-white dark:bg-stone-950 p-3 rounded-xl border border-stone-200 dark:border-stone-800 shadow-sm text-left space-y-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-xs text-stone-800 dark:text-stone-200">
                                        {{ $comment->name }}
                                    </span>
                                    <span class="text-[10px] px-2 py-0.5 rounded-full {{ $comment->presence === 'Hadir' ? 'bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300' : 'bg-rose-100 dark:bg-rose-950 text-rose-700 dark:text-rose-300' }}">
                                        {{ $comment->presence === 'Hadir' ? '✅ Hadir' : '❌ Berhalangan' }}
                                    </span>
                                </div>
                                <p class="text-xs text-stone-600 dark:text-stone-400 leading-relaxed whitespace-pre-line">
                                    {{ $comment->message }}
                                </p>
                                <div class="text-[9px] text-stone-400 dark:text-stone-500 pt-1">
                                    {{ $comment->created_at->diffForHumans() }}
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-center text-stone-400 dark:text-stone-600 py-4">
                                Belum ada ucapan. Jadilah yang pertama memberikan doa restu!
                            </p>
                        @endforelse

                        <div class="mt-4">
                            {{ $comments->links() }}
                        </div>
                    </div>

                </div>


                <div id="comments-container" class="max-w-xs mx-auto space-y-3 text-left"></div>
            </section>

            <!-- Footer Section -->
            <footer
                class="py-8 px-6 text-center text-xs text-stone-500 dark:text-stone-400 border-t border-stone-300 dark:border-stone-800 flex flex-col items-center">
                <img src="images/ornamen-bawah.png" onerror="this.style.display='none'" alt="Footer"
                    class="w-full max-w-xs h-auto rounded-xl object-cover -mt-8 mb-4 shadow-sm">

                <p class="mb-2">Atas kehadiran dan doa restu Bapak/Ibu/Saudara/i, kami ucapkan terima kasih.</p>
                <p class="font-esthetic text-3xl text-brand-500 my-2">Tuhan Memberkati Kita Semua</p>

                <div class="flex justify-center items-center gap-2 my-4 opacity-60">
                    <div class="h-[1px] w-12 bg-stone-400 dark:bg-stone-600"></div>
                    <img src="images/bunga-tengah.png" onerror="this.style.display='none'" alt="Ornamen"
                        class="h-16 object-contain">
                    <div class="h-[1px] w-12 bg-stone-400 dark:bg-stone-600"></div>
                </div>

                <p class="text-[10px] text-stone-400 dark:text-stone-500 mt-2">Built with <i
                        class="fa-solid fa-heart text-red-500"></i> by Erik</p>
            </footer>

            <!-- Bottom Navigation Bar -->
            <nav
                class="fixed bottom-0 left-0 right-0 lg:left-auto lg:w-1/2 xl:w-2/5 bg-white/90 dark:bg-stone-950/90 backdrop-blur-md border-t border-stone-200 dark:border-stone-800 z-40 px-4 py-2 shadow-lg">
                <ul class="flex justify-around items-center text-center max-w-md mx-auto">
                    <li>
                        <a href="#home"
                            class="flex flex-col items-center text-stone-500 dark:text-stone-400 hover:text-brand-500 transition">
                            <i class="fa-solid fa-house text-sm"></i>
                            <span class="text-[10px] mt-0.5">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#bride"
                            class="flex flex-col items-center text-stone-500 dark:text-stone-400 hover:text-brand-500 transition">
                            <i class="fa-solid fa-user-group text-sm"></i>
                            <span class="text-[10px] mt-0.5">Mempelai</span>
                        </a>
                    </li>
                    <li>
                        <a href="#story"
                            class="flex flex-col items-center text-stone-500 dark:text-stone-400 hover:text-brand-500 transition">
                            <i class="fa-solid fa-heart text-sm"></i>
                            <span class="text-[10px] mt-0.5">Story</span>
                        </a>
                    </li>
                    <li>
                        <a href="#wedding-date"
                            class="flex flex-col items-center text-stone-500 dark:text-stone-400 hover:text-brand-500 transition">
                            <i class="fa-solid fa-calendar-check text-sm"></i>
                            <span class="text-[10px] mt-0.5">Acara</span>
                        </a>
                    </li>
                    <li>
                        <a href="#comment"
                            class="flex flex-col items-center text-stone-500 dark:text-stone-400 hover:text-brand-500 transition">
                            <i class="fa-solid fa-comments text-sm"></i>
                            <span class="text-[10px] mt-0.5">Ucapan</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>

    <!-- Floating Buttons Container -->
    <div class="fixed bottom-16 right-4 z-40 flex flex-col gap-2">
        <button id="btn-theme" onclick="toggleTheme()" title="Ganti Mode Tampilan"
            class="w-10 h-10 bg-white/90 dark:bg-stone-800/90 border border-stone-200 dark:border-stone-700 text-stone-800 dark:text-stone-200 rounded-full flex items-center justify-center shadow-lg backdrop-blur-xs transition hover:scale-110 cursor-pointer">
            <i id="theme-icon" class="fa-solid fa-moon"></i>
        </button>

        <button id="btn-audio" onclick="toggleAudio()" title="Musik Background"
            class="w-10 h-10 bg-white/90 dark:bg-stone-800/90 border border-stone-200 dark:border-stone-700 text-stone-800 dark:text-stone-200 rounded-full flex items-center justify-center shadow-lg backdrop-blur-xs transition hover:scale-110 cursor-pointer">
            <i id="audio-icon" class="fa-solid fa-music"></i>
        </button>
    </div>

    <!-- Image Modal Lightbox -->
    <div id="modal-image" class="fixed inset-0 z-50 bg-black/90 hidden items-center justify-center p-4"
        onclick="closeModal()">
        <div class="relative max-w-lg w-full">
            <img id="modal-img-target" src="" class="w-full h-auto rounded-lg shadow-2xl"
                alt="Enlarged view">
            <button onclick="closeModal()" class="absolute -top-10 right-0 text-white text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>

    <!-- JavaScript Logic -->
    <script>
        // Registrasi Komponen Alpine JS Terisolasi agar Tidak Bentrok dengan Scope Lain
        document.addEventListener("alpine:init", () => {
            Alpine.data("intersectSection", () => ({
                show: false,
                triggerShow() {
                    this.show = true;
                }
            }));
        });

        function revealStory() {
            const content = document.getElementById("story-content");
            const overlay = document.getElementById("story-overlay");

            if (content && overlay) {
                content.classList.remove("blur-md", "select-none");
                overlay.classList.add("opacity-0", "pointer-events-none");
                setTimeout(() => {
                    overlay.style.display = "none";
                }, 500);
            }
        }

        let commentsData = [];

        async function loadComments() {
            let jsonComments = [];
            try {
                const response = await fetch("data/ucapan.json");
                if (response.ok) {
                    jsonComments = await response.json();
                }
            } catch (error) {
                console.warn("Fetch data ucapan tidak ditemukan, memuat penyimpanan lokal.");
            }

            const userSubmitted = JSON.parse(localStorage.getItem("wedding_user_ucapan") || "[]");
            commentsData = [...userSubmitted, ...jsonComments];
            renderComments();
        }

        function renderComments() {
            const container = document.getElementById("comments-container");
            if (!container) return;

            container.innerHTML = "";

            if (commentsData.length === 0) {
                container.innerHTML = `<p class="text-xs text-stone-400 text-center italic">Belum ada ucapan.</p>`;
                return;
            }

            commentsData.forEach(item => {
                const badgeColor = item.presence === "Hadir" ?
                    "bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-400 border-emerald-300 dark:border-emerald-800" :
                    "bg-rose-100 dark:bg-rose-950/80 text-rose-700 dark:text-rose-400 border-rose-300 dark:border-rose-800";

                const card = document.createElement("div");
                card.className =
                    "bg-white/90 dark:bg-stone-950/80 p-3.5 rounded-xl border border-stone-200 dark:border-stone-800 shadow-xs";
                card.innerHTML = `
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-xs font-semibold text-brand-500">${item.name}</span>
                        <span class="text-[10px] ${badgeColor} border px-1.5 py-0.5 rounded">${item.presence}</span>
                    </div>
                    <p class="text-xs text-stone-600 dark:text-stone-300">${item.message}</p>
                `;
                container.appendChild(card);
            });
        }

        // Helper fungsi fetch dengan timeout agar tidak menggantung
        const fetchWithTimeout = (url, options = {}, timeout = 2500) => {
            return Promise.race([
                fetch(url, options),
                new Promise((_, reject) => setTimeout(() => reject(new Error('Timeout')), timeout))
            ]);
        };

        // Handle Comment submit
        async function handleCommentSubmit(e) {
            e.preventDefault();

            const submitBtn = e.target.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;

            // Indikator loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = `<i class="fa-solid fa-spinner fa-spin mr-1"></i> Memproses...`;

            const nameInput = document.getElementById("form-name").value;
            const presenceInput = document.getElementById("form-presence").value;
            const messageInput = document.getElementById("form-message").value;

            // 1. Ambil IP Address (Maksimal tunggu 2.5 detik)
            let ipAddress = "Tidak diketahui";
            try {
                const ipRes = await fetchWithTimeout("https://api.ipify.org?format=json", {}, 2500);
                if (ipRes.ok) {
                    const ipData = await ipRes.json();
                    ipAddress = ipData.ip || "Tidak diketahui";
                }
            } catch (err) {
                console.warn("Gagal/Timeout mengambil IP:", err.message);
            }

            // 2. Ambil Lokasi GPS (Default null)
            let locationData = null;
            if ("geolocation" in navigator) {
                try {
                    const position = await new Promise((resolve) => {
                        navigator.geolocation.getCurrentPosition(
                            (pos) => resolve(pos),
                            () => resolve(null), // Jika ditolak atau error
                            {
                                timeout: 2500,
                                enableHighAccuracy: false
                            }
                        );
                    });

                    if (position && position.coords) {
                        locationData = {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude
                        };
                    }
                } catch (err) {
                    console.warn("Gagal mengambil lokasi:", err.message);
                }
            }

            // 3. Ambil User Agent
            const userAgent = navigator.userAgent;

            // Susun objek data ucapan baru
            const newComment = {
                name: nameInput,
                presence: presenceInput,
                message: messageInput,
                ip_address: ipAddress,
                user_agent: userAgent,
                created_at: new Date().toISOString()
            };

            // Tambahkan properti location HANYA jika lokasi ditemukan
            if (locationData) {
                newComment.location = locationData;
            }

            // 4. Update UI Tampilan secara langsung
            if (typeof commentsData !== "undefined") {
                commentsData.unshift(newComment);
            }
            if (typeof renderComments === "function") {
                renderComments();
            }

            // Reset Form & Tombol
            e.target.reset();
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
        }
        // end comment submit
        function createHeartBurst() {
            const container = document.getElementById("heart-container");
            if (!container) return;

            const heartIcons = ["fa-heart", "fa-heart", "fa-hand-holding-heart"];
            const colors = ["#e0a996", "#8c5040", "#f43f5e", "#ec4899"];

            for (let i = 0; i < 35; i++) {
                setTimeout(() => {
                    const heart = document.createElement("i");
                    const randomIcon = heartIcons[Math.floor(Math.random() * heartIcons.length)];
                    const randomColor = colors[Math.floor(Math.random() * colors.length)];

                    heart.className = `fa-solid ${randomIcon} heart-particle`;
                    heart.style.left = Math.random() * 100 + "vw";
                    heart.style.bottom = "-20px";
                    heart.style.color = randomColor;
                    heart.style.fontSize = (Math.random() * 18 + 12) + "px";
                    heart.style.animationDuration = (Math.random() * 1.5 + 1.8) + "s";

                    container.appendChild(heart);

                    setTimeout(() => {
                        heart.remove();
                    }, 3000);
                }, i * 60);
            }
        }

        // FUNGSI UTAMA BUKA UNDANGAN TANPA CRASH / BENTROKAN
        function openInvitation() {
            const welcome = document.getElementById("welcome");
            const root = document.getElementById("root");
            const audioPlayer = document.getElementById("audio-player");
            const audioIcon = document.getElementById("audio-icon");

            if (typeof createHeartBurst === "function") {
                createHeartBurst();
            }

            if (welcome) {
                welcome.style.pointerEvents = "none";
                welcome.style.transition = "opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1)";
                welcome.style.opacity = "0";

                setTimeout(() => {
                    welcome.style.display = "none";
                    if (window.ScrollTrigger) {
                        ScrollTrigger.refresh();
                    }
                }, 800);
            }

            if (root) {
                root.classList.remove("opacity-0");
            }

            if (audioPlayer) {
                audioPlayer.play().then(() => {
                    window.isPlaying = true;
                    if (audioIcon) audioIcon.classList.add("fa-spin");
                }).catch(e => {
                    console.log("Autoplay musik dicegah oleh kebijakan browser:", e);
                });
            }
        }

        // Countdown Timer
        const targetDate = new Date("2026-10-10T13:00:00+07:00").getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const difference = targetDate - now;

            if (difference > 0) {
                const days = Math.floor(difference / (1000 * 60 * 60 * 24));
                const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((difference % (1000 * 60)) / 1000);

                const elDays = document.getElementById("days");
                const elHours = document.getElementById("hours");
                const elMinutes = document.getElementById("minutes");
                const elSeconds = document.getElementById("seconds");

                if (elDays) elDays.innerText = days;
                if (elHours) elHours.innerText = hours;
                if (elMinutes) elMinutes.innerText = minutes;
                if (elSeconds) elSeconds.innerText = seconds;
            }
        }
        setInterval(updateCountdown, 1000);

        // Theme Toggle Handler
        function updateThemeIcon() {
            const themeIcon = document.getElementById("theme-icon");
            if (!themeIcon) return;
            if (document.documentElement.classList.contains("dark")) {
                themeIcon.className = "fa-solid fa-sun text-amber-400";
            } else {
                themeIcon.className = "fa-solid fa-moon text-stone-700";
            }
        }

        function toggleTheme() {
            document.documentElement.classList.toggle("dark");
            updateThemeIcon();
        }

        // Audio Controls
        window.isPlaying = false;

        function toggleAudio() {
            const audioPlayer = document.getElementById("audio-player");
            const audioIcon = document.getElementById("audio-icon");

            if (!audioPlayer) return;

            if (window.isPlaying) {
                audioPlayer.pause();
                if (audioIcon) audioIcon.classList.remove("fa-spin");
            } else {
                audioPlayer.play();
                if (audioIcon) audioIcon.classList.add("fa-spin");
            }
            window.isPlaying = !window.isPlaying;
        }

        function copyToClipboard(text, btnElement) {
            navigator.clipboard.writeText(text).then(() => {
                const originalHTML = btnElement.innerHTML;
                btnElement.innerHTML = `<i class="fa-solid fa-check"></i> Copied`;
                setTimeout(() => {
                    btnElement.innerHTML = originalHTML;
                }, 2000);
            });
        }

        function openModal(src) {
            const modalTarget = document.getElementById("modal-img-target");
            const modal = document.getElementById("modal-image");
            if (modalTarget && modal) {
                modalTarget.src = src;
                modal.classList.remove("hidden");
                modal.classList.add("flex");
            }
        }

        function closeModal() {
            const modal = document.getElementById("modal-image");
            if (modal) {
                modal.classList.add("hidden");
                modal.classList.remove("flex");
            }
        }

        // GSAP Initialization
        function initWeddingMotion() {
            if (!window.gsap) return;
            gsap.registerPlugin(ScrollTrigger);

            const reduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
            if (reduced) {
                document.querySelectorAll(".reveal-motion").forEach(el => {
                    el.classList.add("revealed");
                    el.style.opacity = "1";
                    el.style.transform = "none";
                });
                return;
            }

            const welcomeContent = document.getElementById("welcome-content");
            if (welcomeContent) {
                gsap.from(welcomeContent.children, {
                    y: 28,
                    opacity: 0,
                    duration: 1.05,
                    stagger: .11,
                    ease: "power3.out",
                    delay: .15
                });
            }

            gsap.utils.toArray(".reveal-motion").forEach(section => {
                gsap.fromTo(section, {
                    opacity: 0,
                    y: 38,
                    scale: .985
                }, {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 1.05,
                    ease: "power3.out",
                    scrollTrigger: {
                        trigger: section,
                        start: "top 82%",
                        once: true
                    }
                });
            });

            gsap.utils.toArray(".motion-card").forEach((el) => {
                gsap.fromTo(el, {
                    y: 18,
                    rotateX: 3
                }, {
                    y: 0,
                    rotateX: 0,
                    duration: .9,
                    ease: "power3.out",
                    scrollTrigger: {
                        trigger: el,
                        start: "top 88%",
                        once: true
                    }
                });
            });
        }

        document.addEventListener("DOMContentLoaded", () => {
            loadComments();
            updateCountdown();
            updateThemeIcon();
            setTimeout(initWeddingMotion, 100);
        });
    </script>
</div>
