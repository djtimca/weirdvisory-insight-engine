<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim's Weirdvisory Strategic Insight Engine</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton&family=Quicksand:wght@300;400;500;600;700&display=swap">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <style>
        :root {
            --color-dark-brown: #463f3a;
            --color-medium-brown: #8a817c;
            --color-light-brown: #bcb8b1;
            --color-off-white: #f4f3ee;
            --color-accent: #e0afa0;
        }
        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(135deg, var(--color-dark-brown), var(--color-medium-brown)); /* New gradient with our palette */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            color: var(--color-off-white); /* Light text for contrast */
        }
        h1, h2, h3, h4, h5, h6, .display-4 {
            font-family: 'Anton', sans-serif;
            letter-spacing: 0.02em;
        }
        .container-custom {
            background-color: rgba(70, 63, 58, 0.85); /* Dark brown with transparency */
            backdrop-filter: blur(8px); /* Subtle blur effect */
            border-radius: 1.5rem; /* More rounded corners */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3); /* Deeper shadow */
            border: 1px solid var(--color-accent); /* Accent color border */
        }
        .text-gradient {
            color: var(--color-accent);
            font-weight: 900;
            font-size: 1.5em;
            text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.4);
        }
        .btn-custom {
            background: linear-gradient(90deg, var(--color-accent), var(--color-medium-brown)); /* Accent to medium brown for button */
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: var(--color-off-white);
        }
        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(224, 175, 160, 0.4);
        }
        textarea {
            background-color: rgba(188, 184, 177, 0.2) !important; /* Light brown with transparency */
            border: 1px solid var(--color-medium-brown) !important;
            color: var(--color-off-white) !important;
        }
        textarea::placeholder {
            color: var(--color-light-brown) !important;
        }
        .bg-dark {
            background-color: rgba(70, 63, 58, 0.7) !important; /* Dark brown with transparency */
        }
        a, .text-info {
            color: var(--color-accent) !important;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <div class="container container-custom p-4 p-md-5">

        <header class="text-center mb-5">
            <h1 class="display-4 fw-bolder text-gradient mb-3">
                Tim's Weirdvisory Strategic Insight Engine
            </h1>
            <p class="lead fw-bold text-purple-200" style="font-size: 1.4em;">
                "Sometimes the questions are complicated and the answers are simple." <br> - Dr. Seuss <i class="fas fa-search-dollar"></i><i class="fas fa-lightbulb"></i>
            </p>
            <p class="mt-4 fs-5 text-purple-100">
                Welcome to an unconventional approach to strategic challenges. At WierdAdvisory, we thrive on the complex and the 'weird.' This engine offers a glimpse into how I approach unlocking strategic insights. <i class="fas fa-rocket"></i>
            </p>
        </header>

        <section class="mb-5">
            <h2 class="h3 fw-bold text-gradient mb-4 text-center">
                Got a Weird Problem? Let's Untangle It! <i class="fas fa-brain"></i>
            </h2>
            <textarea
                id="problemInput"
                class="form-control mb-4 shadow-sm"
                rows="5"
                placeholder="Describe your weird, complex, or unconventional strategic challenge (e.g., 'Our legacy systems are holding us back from innovation,' or 'How do we integrate a recent acquisition without losing key talent?')..."
            ></textarea>
            <div class="text-center">
                <button
                    id="generateInsightBtn"
                    class="btn btn-custom btn-lg rounded-pill px-5 shadow"
                >
                    Generate Strategic Insight <i class="fas fa-magic"></i>
                </button>
            </div>
        </section>

        <section class="mb-5">
            <h2 class="h3 fw-bold text-gradient mb-4 text-center">
                Strategic Insight Generated by Tim's Engine: <i class="fas fa-star-of-life"></i>
            </h2>
            <div
                id="insightOutput"
                class="bg-dark p-4 rounded-3 text-center fs-5 shadow-sm"
                style="min-height: 100px; display: flex; align-items: center; justify-content: center;"
            >
                Input your problem above and click 'Generate' to see the magic happen!
            </div>
        </section>

        <section class="mb-5 text-center">
            <h2 class="h3 fw-bold text-gradient mb-4">
                Meet the Architect Behind the Insight: Tim Empringham
            </h2>
            <p class="fs-5 text-purple-100 mb-3">
                This engine is powered by the strategic mind of Tim Empringham, a seasoned business and technology executive with over 25 years of leadership experience. I excel in driving transformative business value through strategic business innovation and technology solutions. I'm passionate about testing emerging AI and development capabilities through personal projects to test the thresholds of 'the art of the possible'.
            </p>
            <p class="fs-5 text-purple-100 mb-2">
                Connect with me on LinkedIn: <a href="https://linkedin.com/in/succeedsooner" target="_blank" class="text-info fw-bold text-decoration-none">linkedin.com/in/succeedsooner <i class="fab fa-linkedin"></i></a>
            </p>
            <p class="fs-5 text-purple-100">
                View my full resume: <a href="/downloads/Tim Empringham - Resume - 2025.pdf" target="_blank" class="text-info fw-bold text-decoration-none">Tim Empringham - Resume - 2025.pdf <i class="fas fa-file-alt"></i></a> (or note it's attached to the email)
            </p>
        </section>

        <section class="mb-5">
            <h2 class="h3 fw-bold text-gradient mb-4 text-center">
                What Makes Me 'Good-Weird'? <i class="fas fa-hat-wizard"></i>
            </h2>
            <div class="row g-4 fs-5 text-purple-100">
                <div class="col-md-6">
                    <p class="p-3 bg-dark rounded-3 shadow-sm h-100">
                        I embrace unconventional thinking to solve stubborn problems. Like when I swapped digital design tools for a Lego kit to physically rethink a complex aerospace component, successfully meeting a tight manufacturing deadline. Sometimes, getting hands-on in a 'good-weird' way is the breakthrough. <i class="fas fa-cube"></i><i class="fas fa-screwdriver-wrench"></i>
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="p-3 bg-dark rounded-3 shadow-sm h-100">
                        Or, when piloting new AI tooling, I didn't settle for existing limitations. I set up competitive 'guilds' to quickly prototype two MVP solutions, leading to a winning AI integration within two weeks. It's about creative drive and a bit of healthy competition to find the best path forward. <i class="fas fa-robot"></i><i class="fas fa-trophy"></i>
                    </p>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <h2 class="h3 fw-bold text-gradient mb-4 text-center">
                The Kind of 'Weird Problems' That Excite Me <i class="fas fa-fire-alt"></i>
            </h2>
            <p class="fs-5 text-purple-100 text-center bg-dark p-4 rounded-3 shadow-sm">
                I'm genuinely fascinated by challenges that demand a fresh perspective: untangling complex legacy systems, orchestrating large-scale digital transformations (especially post-M&A like the HSBC acquisition), leveraging AI to unlock unprecedented operational efficiency, and creating new revenue streams through product innovation. If it's a 'weird' problem requiring strategic breakthrough and a bit of 'unblocking', I'm eager to dive in! My experience spans finance, CPG/manufacturing, e-commerce, aerospace, and supply chain, preparing me for diverse challenges. <i class="fas fa-globe-americas"></i><i class="fas fa-briefcase"></i>
            </p>
        </section>

        <section class="mb-5">
            <h2 class="h3 fw-bold text-gradient mb-4 text-center">
                My Go-To AI Superpower Use Case <i class="fas fa-microchip"></i>
            </h2>
            <p class="fs-5 text-purple-100 text-center bg-dark p-4 rounded-3 shadow-sm">
                For me, the single best use case for AI is its power to automate and accelerate code generation and testing. This doesn't just improve DevOps performance; it frees up brilliant human minds from repetitive tasks, allowing them to focus entirely on the truly strategic, creative problem-solving, and innovation that drives real business value. It's about augmenting human potential to reach 'the art of the possible.' <i class="fas fa-head-side-brain"></i><i class="fas fa-code"></i>
            </p>
        </section>

        <footer class="text-center pt-4 border-top border-secondary-subtle">
            <h2 class="h3 fw-bold text-gradient mb-4">
                Ready to Discuss More 'Weirdness'? <i class="fas fa-handshake"></i>
            </h2>
            <p class="fs-5 text-purple-100 mb-3">
                Let's connect and explore how my strategic leadership and unconventional approaches can bring transformative value to WierdAdvisory's clients.
            </p>
            <p class="fs-4 fw-semibold text-info">
                Email me at: <a href="mailto:tim.empringham@live.ca" class="text-info text-decoration-none hover-underline">tim.empringham@live.ca <i class="fas fa-envelope"></i></a><br/>
                Call me at: <a href="tel:289-690-1569" class="text-info text-decoration-none hover-underline">289-690-1569 <i class="fas fa-phone"></i></a>
            </p>
        </footer>
        
        <hr class="my-5 border-secondary-subtle">
        
        <section class="mb-5">
            <h2 class="h3 fw-bold text-gradient mb-4 text-center">
                Explore the Source Code <i class="fab fa-github"></i>
            </h2>
            <p class="fs-5 text-purple-100 text-center bg-dark p-4 rounded-3 shadow-sm">
                Curious about how this insight engine works? This project is open source! Check out the code repository to see how I've built this application using Laravel, Bootstrap, and modern web technologies. It's a great example of my approach to clean, efficient code and user experience design.
            </p>
            <div class="text-center mt-4">
                <a href="https://github.com/djtimca/weirdvisory-insight-engine" target="_blank" class="btn btn-custom btn-lg rounded-pill px-5 shadow" style="color: var(--color-off-white);">
                    View on GitHub <i class="fab fa-github"></i>
                </a>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.getElementById('generateInsightBtn').addEventListener('click', async () => {
            const problemInput = document.getElementById('problemInput').value;
            const insightOutput = document.getElementById('insightOutput');

            if (!problemInput.trim()) {
                insightOutput.innerHTML = '<span class="text-warning">Please describe a problem first! <i class="fas fa-frown-open"></i></span>';
                return;
            }

            insightOutput.innerHTML = '<span class="text-info animate-pulse"><i class="fas fa-spinner fa-spin me-2"></i>Analyzing weirdness... 🧐</span>';

            try {
                // Use direct web route for insight generation
                const apiUrl = `${window.location.origin}/generate-insight-web`;
                
                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Laravel CSRF token
                    },
                    body: JSON.stringify({ problem: problemInput })
                });
                
                const data = await response.json();

                if (response.ok) {
                    insightOutput.innerHTML = data.insight;
                } else {
                    insightOutput.innerHTML = `<span class="text-danger">Error: ${data.error || 'Something went wrong on the server.'} <i class="fas fa-exclamation-triangle"></i></span>`;
                    console.error('API error:', data.error || 'Unknown server error');
                }
            } catch (error) {
                console.error('Fetch error:', error);
                insightOutput.innerHTML = '<span class="text-danger">Network error. Please try again. <i class="fas fa-wifi-slash"></i></span>';
            }
        });
    </script>
</body>
</html>
