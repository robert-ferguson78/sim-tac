// Debug configuration
const CONFIG = {
    DEBUG_MODE: false  // Set to false to disable all logging
};

// Debug utility
const DEBUG = {
    log: (type, message, data = null) => {
        if (!CONFIG.DEBUG_MODE) return;
        
        const icons = {
            api: '✅',
            video: '📺',
            mouse: '🖱️',
            player: '🎮',
            state: '🔄'
        };
        console.log(`${icons[type]} ${message}`, data || '');
    }
};

let player = null;
let hasInteracted = false;

// Only create player when needed
function createPlayer(containerId, videoId, quality) {
    return new YT.Player(containerId, {
        videoId: videoId,
        width: '100%',
        height: '100%',
        playerVars: {
            autoplay: 1,
            controls: 0,
            mute: 1,
            playsinline: 1,
            rel: 0,
            showinfo: 0,
            vq: quality || 'hd1080',
            modestbranding: 1,
            enablejsapi: 1,
            origin: window.location.origin,
            host: 'https://www.youtube-nocookie.com',
            loop: 1,
            playlist: videoId  // Required for looping - must specify same video ID
        },
        events: {
            onReady: (event) => event.target.playVideo(),
            onStateChange: (event) => {
                // When video ends (state = 0), restart playback
                if (event.data === YT.PlayerState.ENDED) {
                    event.target.playVideo();
                }
            }
        }
    });
}
function onYouTubeIframeAPIReady() {
    const videoHeight = document.querySelector('.video-height');
    videoHeight.style.pointerEvents = 'none';
    
    // Add mouse movement detection
    document.addEventListener('mousemove', handleMouseMove, { passive: true });
}
function handleMouseMove(event) {
    if (!hasInteracted) {
        hasInteracted = true;
        
        const playerContainer = document.querySelector('.youtube-player');
        const videoId = playerContainer.dataset.videoId;
        const quality = playerContainer.dataset.quality;
        const videoContainer = document.querySelector('.video-container');
        const placeholderImage = document.querySelector('.placeholder-image');
        
        // Create player immediately but keep container hidden
        player = createPlayer(playerContainer.id, videoId, quality);
        
        // Set up transitions
        placeholderImage.style.transition = 'opacity 0.3s ease';
        videoContainer.style.transition = 'opacity 0.3s ease';
        
        // After 1.5s delay, perform the transition
        setTimeout(() => {
            placeholderImage.style.opacity = '0';
            videoContainer.classList.add('video-playing');
            playerContainer.style.opacity = '1';
            
            // Clean up after transition
            setTimeout(() => {
                placeholderImage.remove();
            }, 300);
        }, 1500);
        
        document.removeEventListener('mousemove', handleMouseMove);
    }
}
// Load YouTube API
const tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
const firstScriptTag = document.getElementsByTagName('script')[0];firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);console.log('⚡ YouTube API Script injected');