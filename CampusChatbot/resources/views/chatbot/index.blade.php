@extends('layouts.app')

@section('title', 'Chatbot - Campus Chatbot')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card chat-card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <i class="fas fa-robot me-2"></i>
                            <strong>Campus Assistant</strong>
                            <span class="badge bg-success ms-2">Online</span>
                        </div>
                        <button class="btn btn-sm btn-light" onclick="clearChat()">
                            <i class="fas fa-trash-alt"></i> Hapus Chat
                        </button>
                    </div>
                    <div class="card-body p-0" style="overflow-y: scroll" id="chatMessagesContainer">
                        <div class="chat-messages" id="chatMessages">
                            <div class="welcome-message">
                                <div class="bot-avatar">
                                    <i class="fas fa-robot"></i>
                                </div>
                                <div class="welcome-text">
                                    <h5>Selamat Datang! 👋</h5>
                                    <p>Saya adalah asisten virtual kampus yang siap membantu Anda. Tanyakan apa saja
                                        tentang:</p>
                                    <div class="suggestion-chips">
                                        <span class="chip" onclick="askQuestion('jadwal senin apa')">
                                            <i class="fas fa-calendar"></i> Jadwal Kuliah
                                        </span>
                                        <span class="chip" onclick="askQuestion('dimana lab komputer 1')">
                                            <i class="fas fa-map-marker-alt"></i> Lokasi Ruangan
                                        </span>
                                        <span class="chip" onclick="askQuestion('cara daftar krs')">
                                            <i class="fas fa-file-alt"></i> Administrasi
                                        </span>
                                        <span class="chip" onclick="askQuestion('beasiswa apa saja')">
                                            <i class="fas fa-graduation-cap"></i> Beasiswa
                                        </span>
                                    </div>
                                </div>
                            </div>

                            @foreach ($chatHistories as $chat)
                                <div class="message user-message">
                                    <div class="message-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="message-content">
                                        <div class="message-text">{{ $chat->question }}</div>
                                        <div class="message-time">{{ $chat->created_at->format('H:i') }}</div>
                                    </div>
                                </div>
                                <div class="message bot-message">
                                    <div class="message-avatar bot-avatar">
                                        <i class="fas fa-robot"></i>
                                    </div>
                                    <div class="message-content">
                                        <div class="message-text">{!! nl2br(e($chat->answer)) !!}</div>
                                        <div class="message-time">
                                            {{ $chat->created_at->format('H:i') }}
                                            @if ($chat->confidence_score > 0)
                                                <span class="confidence-badge ms-2">
                                                    <i class="fas fa-check-circle"></i>
                                                    {{ number_format($chat->confidence_score, 0) }}%
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <form id="chatForm" class="d-flex gap-2">
                            @csrf
                            <input type="text" id="questionInput" class="form-control"
                                placeholder="Ketik pertanyaan Anda..." required autocomplete="off">
                            <button type="submit" class="btn btn-primary" id="sendBtn">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                        <div id="typingIndicator" class="typing-indicator" style="display: none;">
                            <span></span><span></span><span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .chat-card {
            height: 85vh;
            display: flex;
            flex-direction: column;
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 2rem;
            background: #f8f9fa;
            scroll-behavior: smooth;
        }

        .welcome-message {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .bot-avatar {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: var(--shadow-elegant);
        }

        .welcome-text h5 {
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .suggestion-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
            margin-top: 1rem;
        }

        .chip {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: var(--primary-glow);
            color: var(--primary);
            border-radius: 20px;
            cursor: pointer;
            transition: var(--transition-smooth);
            font-size: 0.9rem;
            border: 1px solid transparent;
        }

        .chip:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(27, 73, 148, 0.2);
        }

        .message {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .user-message {
            flex-direction: row-reverse;
        }

        .message-avatar {
            width: 40px;
            height: 40px;
            background: #6c757d;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }

        .bot-message .message-avatar {
            background: var(--gradient-primary);
        }

        .message-content {
            flex: 1;
            max-width: 70%;
        }

        .message-text {
            background: white;
            padding: 1rem 1.25rem;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            line-height: 1.6;
        }

        .user-message .message-text {
            background: var(--gradient-primary);
            color: white;
        }

        .message-time {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 0.5rem;
            padding: 0 0.5rem;
        }

        .confidence-badge {
            background: #d4edda;
            color: #155724;
            padding: 0.125rem 0.5rem;
            border-radius: 12px;
            font-size: 0.7rem;
        }

        .card-footer {
            background: white;
            border-top: 2px solid #e9ecef;
            padding: 1.25rem;
        }

        #questionInput {
            border-radius: 25px;
            padding: 0.75rem 1.25rem;
            border: 2px solid #e9ecef;
            transition: var(--transition-smooth);
        }

        #questionInput:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem var(--primary-glow);
        }

        #sendBtn {
            border-radius: 50%;
            width: 48px;
            height: 48px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .typing-indicator {
            display: flex;
            gap: 0.25rem;
            padding: 0.5rem 1rem;
            margin-top: 0.5rem;
        }

        .typing-indicator span {
            width: 8px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
            animation: typing 1.4s infinite;
        }

        .typing-indicator span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-indicator span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {

            0%,
            60%,
            100% {
                transform: translateY(0);
                opacity: 0.5;
            }

            30% {
                transform: translateY(-10px);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .chat-card {
                height: calc(100vh - 100px);
            }

            .chat-messages {
                padding: 1rem;
            }

            .message-content {
                max-width: 85%;
            }

            .suggestion-chips {
                flex-direction: column;
            }

            .chip {
                width: 100%;
            }
        }
    </style>

    @push('scripts')
        <script>
            const chatMessagesContainer = document.getElementById('chatMessagesContainer');
            const chatMessages = document.getElementById('chatMessages');
            const chatForm = document.getElementById('chatForm');
            const questionInput = document.getElementById('questionInput');
            const sendBtn = document.getElementById('sendBtn');
            const typingIndicator = document.getElementById('typingIndicator');

            // Scroll to bottom on load
            scrollToBottom();

            chatForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const question = questionInput.value.trim();
                if (!question) return;

                // Disable input
                questionInput.disabled = true;
                sendBtn.disabled = true;

                // Add user message
                addMessage(question, 'user');
                questionInput.value = '';

                // Show typing indicator
                typingIndicator.style.display = 'flex';
                scrollToBottom();

                try {
                    const response = await fetch('{{ route('chatbot.ask') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            question
                        })
                    });

                    const data = await response.json();

                    // Hide typing indicator
                    typingIndicator.style.display = 'none';

                    // Add bot message
                    addMessage(data.answer, 'bot', data.confidence);

                } catch (error) {
                    typingIndicator.style.display = 'none';
                    addMessage('Maaf, terjadi kesalahan. Silakan coba lagi.', 'bot', 0);
                }

                // Enable input
                questionInput.disabled = false;
                sendBtn.disabled = false;
                questionInput.focus();
            });

            function addMessage(text, type, confidence = null) {
                const time = new Date().toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${type}-message`;

                const avatar = type === 'bot' ?
                    '<div class="message-avatar bot-avatar"><i class="fas fa-robot"></i></div>' :
                    '<div class="message-avatar"><i class="fas fa-user"></i></div>';

                const confidenceBadge = confidence > 0 ?
                    `<span class="confidence-badge ms-2"><i class="fas fa-check-circle"></i> ${Math.round(confidence)}%</span>` :
                    '';

                messageDiv.innerHTML = `
            ${type === 'user' ? '' : avatar}
            ${type === 'user' ? avatar : ''}
            <div class="message-content">
                <div class="message-text">${text.replace(/\n/g, '<br>')}</div>
                <div class="message-time">${time} ${confidenceBadge}</div>
            </div>
            
        `;

                chatMessages.appendChild(messageDiv);
                scrollToBottom();
            }

            function scrollToBottom() {
                setTimeout(() => {
                    chatMessagesContainer.scrollTop = chatMessages.scrollHeight;
                }, 100);
            }

            function askQuestion(question) {
                questionInput.value = question;
                questionInput.focus();
                chatForm.dispatchEvent(new Event('submit'));
            }

            function clearChat() {
                if (confirm('Apakah Anda yakin ingin menghapus semua chat?')) {
                    // Show loading
                    const sendBtn = document.getElementById('sendBtn');
                    sendBtn.disabled = true;
                    sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                    // Clear from database
                    fetch('{{ route('chatbot.clear') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Clear UI messages
                                const messages = chatMessages.querySelectorAll('.message');
                                messages.forEach(msg => msg.remove());

                                // Show success message
                                const successDiv = document.createElement('div');
                                successDiv.className = 'alert alert-success text-center';
                                successDiv.innerHTML = '<i class="fas fa-check-circle me-2"></i>' + data.message;
                                chatMessages.insertBefore(successDiv, chatMessages.firstChild);

                                // Reload after 1 second
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            } else {
                                alert('Gagal menghapus chat');
                                sendBtn.disabled = false;
                                sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i>';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus chat');
                            sendBtn.disabled = false;
                            sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i>';
                        });
                }
            }
        </script>
    @endpush
@endsection
