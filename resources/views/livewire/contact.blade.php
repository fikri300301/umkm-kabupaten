<div>
    {{-- The whole world belongs to you. --}}
    <div class="card w-100">
        <div class="row">
            <div class="col-lg-5 d-flex align-items-stretch ">
                <div class="info">
                    <div class="address">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Lokasi:</h4>
                        <p>MPMG+VWR, Jl. Ketintang, Ketintang, Kec. Gayungan, Surabaya, Jawa Timur 60231</p>
                    </div>
                    <div class="email">
                        <i class="bi bi-envelope"></i>
                        <h4>Email:</h4>
                        <p>business@bem.fmipa.unesa.ac.id</p>
                    </div>
                    <div class="phone">
                        <i class="bi bi-whatsapp"></i>
                        <h4>Narahubung:</h4>
                        <a href="https://wa.me/+6287861601254" class="text-reset text-decoration-none">
                            <p class="ml-2">087861601254 (Fraya)</p>
                        </a>
                    </div>
                    <iframe style="border:0; width: 100%; height: 290px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d989.3354410166907!2d112.72392875872194!3d-7.3154506999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbe439c4498f%3A0x10d597d7a2244556!2sFMIPA%20UNESA%20GEDUNG%20C5!5e0!3m2!1sid!2sid!4v1689914173375!5m2!1sid!2sid"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                <form role="form" class="php-email-form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" name="name" wire:model.lazy="name" class="form-control" id="name"
                                required placeholder="BEM FMIPA UNESA">
                            @error('name')
                                <div class="alert alert-warning my-2" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Email</label>
                            <input type="email" class="form-control" wire:model.lazy="email" name="email" id="email"
                                required placeholder="admin@bem.fmipa.ac.id">
                            @error('email')
                                <div class="alert alert-warning my-2" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Subjek</label>
                        <input type="text" class="form-control" wire:model.lazy="subject" name="subject" id="subject"
                            required placeholder="BEM FMIPA UNESA">
                        @error('subject')
                            <div class="alert alert-warning my-2" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Message</label>
                        <textarea class="form-control" name="message" wire:model.lazy="message" rows="10" required></textarea>
                        @error('message')
                            <div class="alert alert-warning my-2" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" wire:click="store">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
