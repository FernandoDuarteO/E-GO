@extends('layouts.app')

@section('title', 'E-GO - Messages')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 messages-container">
            <div class="row g-0">
                <!-- Conversations List -->
                <div class="col-md-4">
                    <div class="d-flex justify-content-between align-items-center mb-3 p-3">
                        <h4 class="mb-0">Messages</h4>
                        <div>
                            <span class="badge badge-custom rounded-pill">General 6</span>
                            <span class="badge bg-secondary rounded-pill">Archive 2</span>
                        </div>
                    </div>

                    <div class="search-box mb-3 px-3">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>

                    <div class="conversations-list">
                        <!-- Conversation Items -->
                        <div class="conversation-item active">
                            <div class="d-flex">
                                <div class="conversation-avatar">A</div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-0">Albert Flores</h6>
                                        <span class="conversation-time">10:37</span>
                                    </div>
                                    <p class="conversation-preview mb-0">Hi, I'm confirming your check-in...</p>
                                </div>
                            </div>
                        </div>

                        <div class="conversation-item">
                            <div class="d-flex">
                                <div class="conversation-avatar">A</div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-0">Annette Black</h6>
                                        <span class="conversation-time">9:15</span>
                                    </div>
                                    <p class="conversation-preview mb-0">I'm arriving tomorrow afternoon...</p>
                                </div>
                            </div>
                        </div>

                        <div class="conversation-item">
                            <div class="d-flex">
                                <div class="conversation-avatar">E</div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-0">Edwin Johnson</h6>
                                        <span class="conversation-time">9:01</span>
                                    </div>
                                    <p class="conversation-preview mb-0">Cool! Is there a coffee machine...</p>
                                </div>
                            </div>
                        </div>

                        <div class="conversation-item">
                            <div class="d-flex">
                                <div class="conversation-avatar">J</div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-0">Jerome Bell</h6>
                                        <span class="conversation-time">Thu</span>
                                    </div>
                                    <p class="conversation-preview mb-0">I've received your booking request...</p>
                                </div>
                            </div>
                        </div>

                        <div class="conversation-item">
                            <div class="d-flex">
                                <div class="conversation-avatar">D</div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-0">Darrell Steward</h6>
                                        <span class="conversation-time">Thu</span>
                                    </div>
                                    <p class="conversation-preview mb-0">Hello! Just a reminder that check...</p>
                                    </div>
                                </div>
                            </div>

                        <div class="conversation-item">
                            <div class="d-flex">
                                <div class="conversation-avatar">S</div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-0">Steven Jordan</h6>
                                        <span class="conversation-time">Wed</span>
                                    </div>
                                    <p class="conversation-preview mb-0">Sounds good! Could you confir...</p>
                                </div>
                            </div>
                        </div>

                        <div class="conversation-item">
                            <div class="d-flex">
                                <div class="conversation-avatar">W</div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-0">Wanda Hall</h6>
                                        <span class="conversation-time">Wed</span>
                                    </div>
                                    <p class="conversation-preview mb-0">Thanks for the update! Just to d...</p>
                                </div>
                            </div>
                        </div>

                        <div class="conversation-item">
                            <div class="d-flex">
                                <div class="conversation-avatar">V</div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-0">Victor Olson</h6>
                                        <span class="conversation-time">Wed</span>
                                    </div>
                                    <p class="conversation-preview mb-0"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Property Info -->
                        <div class="property-info">
                            <div class="property-title">+ Bedroom Apartment, 45 m²</div>
                            <div class="property-details">$980/night</div>
                        </div>
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="col-md-8">
                    <div class="chat-container">
                        <div class="chat-header">
                            <div class="conversation-avatar me-3">E</div>
                            <div>
                                <h5 class="mb-0">Edwin Johnson</h5>
                                <small class="text-muted">Online</small>
                            </div>
                        </div>

                        <div class="chat-messages">
                            <!-- Received Message -->
                            <div class="message received">
                                <div class="message-bubble">
                                    Hi! I'm interested in the apartment listing I saw online. Is it still available for next weekend?
                                    <div class="message-time">8:55</div>
                                </div>
                            </div>

                            <!-- Sent Message -->
                            <div class="message sent">
                                <div class="message-bubble">
                                    Hi! Yes, it's available on those dates. Just to confirm will it be just you or are you traveling with others?
                                    <div class="message-time">8:21</div>
                                </div>
                            </div>

                            <!-- Received Message -->
                            <div class="message received">
                                <div class="message-bubble">
                                    We're looking for a place with a nice view or a cozy balcony, if possible.
                                    <div class="message-time">8:54</div>
                                </div>
                            </div>

                            <!-- Received Message -->
                            <div class="message received">
                                <div class="message-bubble">
                                    It'll be me and one friend.
                                    <div class="message-time">8:56</div>
                                </div>
                            </div>

                            <!-- Received Message -->
                            <div class="message received">
                                <div class="message-bubble">
                                    Cool! Is there a coffee machine or kettle in the kitchen?
                                    <div class="message-time">9:01</div>
                                </div>
                            </div>
                        </div>

                        <div class="chat-input">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Type a message...">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
