namespace Acessai.Domain.Interfaces.Repositories
{
    public interface IAulaRepository
    {
        Task<bool> ContemAulasAsync(long id);
    }
}
