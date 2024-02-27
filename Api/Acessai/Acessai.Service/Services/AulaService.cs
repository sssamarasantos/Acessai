using Acessai.Domain.Interfaces.Repositories;
using Acessai.Domain.Interfaces.Services;

namespace Acessai.Service.Services
{
    public class AulaService : IAulaService
    {
        private readonly IAulaRepository _aulaRepository;

        public AulaService(IAulaRepository aulaRepository)
        {
            _aulaRepository = aulaRepository;
        }

        public async Task<bool> ContemAulasAsync(long id)
        {
            return await _aulaRepository.ContemAulasAsync(id);
        }
    }
}
