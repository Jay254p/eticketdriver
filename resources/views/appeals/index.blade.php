<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Your Appeals</h2>

                    @if ($appeals->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Ticket ID</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Time Of Hearing</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Court Number</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Offence Commited</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Car Reg Number</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Place Of Offence</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Time Of Offence</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Verdict</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($appeals as $appeal)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $appeal->TicketId }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $appeal->time }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $appeal->roomnumber }}</td>

                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $appeal->offence->OffenceCommited }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $appeal->offence->DriverCarRegNo }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $appeal->offence->PlaceOfOffence }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $appeal->offence->created_at }}</td>
                                        
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $appeal->status }}</td>
                                        <td class="px-6 py-4 whitespace-no-wrap">{{ $appeal->verdict }}</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>You have no appeals.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
