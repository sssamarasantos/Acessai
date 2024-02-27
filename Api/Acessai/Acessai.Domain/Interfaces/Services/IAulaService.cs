namespace Acessai.Domain.Interfaces.Services
{
    public interface IAulaService
    {
        Task<bool> ContemAulasAsync(long id);
    }
}
